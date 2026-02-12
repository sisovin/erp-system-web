# Windows/NVM Build Scripts Guide

Due to Windows/NVM PATH inheritance issues with npm scripts, use the PowerShell scripts directly.

## Quick Reference

### Build CSS (Production)
```powershell
.\build-css.ps1
```

### Watch CSS (Development)
```powershell
.\watch-css.ps1
```

### Start PHP Server
```powershell
# Option 1: If PHP is in PATH
npm start

# Option 2: Laragon-specific (recommended)
npm run laragon:start
```

### Full Development Workflow

**Terminal 1:** Start PHP server
```powershell
npm run laragon:start
```

**Terminal 2:** Watch CSS changes
```powershell
.\watch-css.ps1
```

## Why Not npm run build/watch?

Your Windows/NVM environment has a unique issue where npm script subprocesses don't inherit the PATH properly. The PowerShell scripts (`.ps1`) work perfectly when run directly, so use those instead.

## Available Scripts

| Script | Command | Description |
|--------|---------|-------------|
| Build CSS | `.\build-css.ps1` | Builds minified production CSS |
| Watch CSS | `.\watch-css.ps1` | Watches for changes and rebuilds |
| Start Server | `npm run laragon:start` | Starts PHP dev server |
| Cache Warmup | `npm run cache:warmup` | Pre-populate Redis cache |
| Cache Info | `npm run cache:info` | View cache statistics |
| Cache Flush | `npm run cache:flush` | Clear all cached data |

## Daily Development

```powershell
# Terminal 1: Start the server
npm run laragon:start

# Terminal 2: Watch CSS
.\watch-css.ps1

# Now edit your files - CSS will auto-rebuild!
```

## Production Build

```powershell
# Build optimized CSS
.\build-css.ps1

# Warmup cache
npm run cache:warmup

# Deploy!
```

## Troubleshooting

### CSS not applying?
Run `.\build-css.ps1` to rebuild the CSS file.

### "Cannot be loaded because running scripts is disabled"
Run this once:
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### Server won't start?
Make sure port 8000 isn't already in use:
```powershell
netstat -ano | findstr :8000
```
