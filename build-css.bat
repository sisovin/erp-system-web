@echo off
echo Building Tailwind CSS...
powershell -ExecutionPolicy Bypass -Command "& { & node_modules\.bin\tailwindcss.ps1 -i ./src/input.css -o ./public/css/tailwind.css --minify }"
echo Done!
