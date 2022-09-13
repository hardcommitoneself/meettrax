<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RoachPHP\Roach;
use RoachPHP\Spider\Configuration\Overrides;
use App\Models\Meet;
use App\Models\MeetEvent as Event;
use App\Spiders\RunnerCardMeetEventSpider;

class ScarpRunnerCardMeet extends Command
{
    const EXIT_SUCCESS = 0;
    const EXIT_FAILURE = 1;
    const RUNNERCARD_DICT_BASE_URL = 'https://results.runnercard.com/Results/listFrame.jsp?meetid=';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:runnercard:meet
                                { meet?            : Internal Meet ID }
                                { runnercard_meet? : RunnerCard Meet ID }
                                { --D|dry-run      : Run this command in dry-run mode }
                                { --Y|yes          : Automatic yes to confirm propmpt }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap the RunnerCard IDs of specified meet';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $meet_id = $this->argument('meet');
        $runnercard_meet_id = $this->argument('runnercard_meet');

        if (!$meet_id) {
            $meet_id = $this->ask('What is internal meet id?');
            if (!$meet_id) {
                return self::EXIT_FAILURE;
            }
        }

        if (!$runnercard_meet_id) {
            $runnercard_meet_id = $this->ask('What is RunnerCard meet id?');
            if (!$runnercard_meet_id) {
                return self::EXIT_FAILURE;
            }
        }

        $meet = Meet::findOrFail($meet_id);
        $this->info('Selected internal Meet: #' . $meet_id . ' ' . $meet->name);

        $this->info('Scrapping RunnerCard event IDs of MEET #' . $runnercard_meet_id);
        $dict = Roach::collectSpider(
            RunnerCardMeetEventSpider::class,
            new Overrides(startUrls: [self::RUNNERCARD_DICT_BASE_URL . $runnercard_meet_id]),
        )[0]->all();

        if (empty($dict)) {
            $this->error('Scrapping failed! Please double-check RunnerCard Meet ID.');
            return self::EXIT_FAILURE;
        } else {
            $this->line('Scrapping finished!');
        }

        if (!$this->option('yes')
            && !$this->option('dry-run')
            && !$this->confirm('This operation will update `runnercard_meet_id` and `runnercard_event_id`s. Do you wish to continue?')
        ) {
            $this->warn('Operation cancelled');
            return self::EXIT_SUCCESS;
        }

        $plans = [];
        foreach ($meet->events as $event) {
            $key = $event->name . ' ' . $event->description;

            if (isset($dict[$key]) && $dict[$key]) {
                $plans[] = [$key, $event->id, $dict[$key]];
            }
        }

        if ($this->option('dry-run')) {
            $this->warn('Dry-run mode set!');

            $this->warn('Will set `runnercard_meet_id` = ' . $runnercard_meet_id . ' of Meet #' . $meet_id);
            $this->warn('Will set `runnercard_event_id`s as following table');
            $this->table(['Event Name', 'Internal MeetEvent #', 'RunnerCard Event #'], $plans);
        } else {
            $this->info('Updating `runnercard_meet_id`=' . $runnercard_meet_id);
            $meet->runnercard_meet_id = $runnercard_meet_id;
            $meet->save();
            $this->line('Updated `runnercard_meet_id` of Meet #' . $meet_id);

            $this->info('Updating `runnercard_event_id`s');
            foreach ($plans as $plan) {
                [$meet_name, $event_id, $runnercard_event_id] = $plan;
                Event::findOrFail($event_id)->fill(compact('runnercard_event_id'))->save();
            }
            $this->line('Update finished!');
        }

        return self::EXIT_SUCCESS;
    }
}
