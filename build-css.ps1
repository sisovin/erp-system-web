Write-Host "Building Tailwind CSS..." -ForegroundColor Green
& node_modules\.bin\tailwindcss.ps1 -i ./src/input.css -o ./public/css/tailwind.css --minify
Write-Host "Done!" -ForegroundColor Green
