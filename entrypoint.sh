#!/bin/sh
php-fpm &
npm install
npm run dev
