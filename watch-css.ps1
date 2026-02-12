Write-Host "Watching Tailwind CSS for changes..." -ForegroundColor Green
Write-Host "Press Ctrl+C to stop" -ForegroundColor Yellow
& node_modules\.bin\tailwindcss.ps1 -i ./src/input.css -o ./public/css/tailwind.css --watch
