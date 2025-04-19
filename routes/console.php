<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('uploads:clean')->everyMinute();