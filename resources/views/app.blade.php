<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        {{--      <title inertia>{{ config('app.name') }}</title> --}}
        @vite(
            [
                //! 'resources/css/app.css', 
                'resources/js/app.js'
            ]
        )
        @inertiaHead
    </head>
    <body>
        @routes
        @inertia
    </body>
</html>