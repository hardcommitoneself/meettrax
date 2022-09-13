@props(['url'])
<div >
    <style >
        .wrap {
            width: 320px;
            height: 240px;
            padding: 0;
            overflow: hidden;
        }

        .frame {
            width: 800px;
            height: 600px;
            border: 0;
            -ms-transform: scale(0.40);
            -moz-transform: scale(0.40);
            -o-transform: scale(0.40);
            -webkit-transform: scale(0.40);
            transform: scale(0.40);

            -ms-transform-origin: 0 0;
            -moz-transform-origin: 0 0;
            -o-transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
            transform-origin: 0 0;
        }
    </style >

    <div class="dark:bg-gray-900" >
        <div class="wrap mx-auto" >
            <iframe class="frame"
                    src="{{ $url }}" ></iframe >
        </div >
    </div >
</div >
