# NPM Scripts Guide

## Quick Reference

```bash
# Development server (requires PHP in PATH)
npm start

# Development server (for Laragon on Windows)
npm run laragon:start

# Build CSS for production (Windows-compatible)
npm run build

# Watch CSS changes (Windows-compatible)
npm run watch

# Full development mode (server + CSS watch)
npm run dev                # Generic (requires PHP in PATH)
npm run dev:laragon        # For Laragon on Windows

# CSS watch only
npm run dev:simple

# Redis cache management
npm run cache:warmup       # Pre-populate cache
npm run cache:info         # Cache statistics
npm run cache:flush        # Clear all cache
```

## Detailed Command Reference

### 1. `npm start`

Starts the PHP development server on http://localhost:8000

**Requirements:** PHP must be in system PATH

**Usage:**
```bash
npm start
```

**Output:**
```
PHP 8.5.0 Development Server (http://localhost:8000) started
```

**Troubleshooting:**
If you see `'php' is not recognized...` error:
- **On Windows with Laragon:** Use `npm run laragon:start` instead
- **Or add PHP to PATH:** Add Laragon PHP directory to system PATH

---

### 2. `npm run laragon:start`

**Windows-specific script** for Laragon users. Uses the full path to Laragon's PHP executable.

**Default path:** `D:\laragon\bin\php\php-8.5.0-Win32-vs16-x64\php.exe`

**Customization:**
If your Laragon PHP version is different, edit `package.json`:
```json
"laragon:start": "D:\\laragon\\bin\\php\\php-YOUR-VERSION\\php.exe -S localhost:8000 -t public"
```

**Usage:**
```bash
npm run laragon:start
```

---

### 3. `npm run build`

Builds production-ready CSS with Tailwind CLI. Output is minified for optimal performance.

**Input:** `src/input.css`  
**Output:** `public/css/tailwind.css`

**Usage:**
```bash
npm run build
```

**What it does:**
- Processes Tailwind directives
- Minifies CSS for production
- Removes unused classes (tree-shaking)
- Optimizes file size

**Technical Note:**
Uses `node` directly to run Tailwind CLI, ensuring Windows compatibility without PATH issues.

**When to use:**
- Before deploying to production
- When you want optimized CSS bundle
- After making CSS changes for production build

---

### 4. `npm run watch`

Watches for CSS changes and rebuilds automatically during development.

**Usage:**
```bash
npm run watch
```

**What it does:**
- Monitors `src/input.css` for changes
- Automatically rebuilds `public/css/tailwind.css`
- Keeps running until you stop it (Ctrl+C)

**Technical Note:**
Uses `node` directly to run Tailwind CLI, ensuring Windows compatibility without PATH issues.

**When to use:**
- During active development
- When making frequent CSS/Tailwind changes
- As part of development workflow

**Stopping:**
Press `Ctrl+C` to stop watching

---

### 5. `npm run dev`

**Full development mode** - Runs both server and CSS watch concurrently with color-coded output.

**Requirements:** PHP in system PATH

**Usage:**
```bash
npm run dev
```

**What it does:**
- Starts PHP server on localhost:8000 (blue output)
- Starts CSS watch mode (green output)
- Both processes run simultaneously in one terminal

**Output:**
```
[SERVER] PHP 8.5.0 Development Server started
[CSS] Rebuilding...
[CSS] Done in 234ms
```

**Stop:** Press `Ctrl+C` to stop both processes

---

### 6. `npm run dev:laragon`

**Laragon-specific full development mode** - Same as `npm run dev` but uses Laragon PHP path.

**Usage:**
```bash
npm run dev:laragon
```

**Perfect for:** Windows users with Laragon

---

### 7. `npm run dev:simple`

**CSS watch only** - Runs only the Tailwind CSS watcher without starting the server.

**Usage:**
```bash
npm run dev:simple
```

**Use case:**
- When you already have a server running (e.g., via Laragon GUI)
- When you only need to work on CSS/styling
- Running PHP server separately: `php -S localhost:8000 -t public/`

---

### 8. `npm run cache:warmup`

Pre-populates Redis cache with frequently accessed data (roles, permissions, settings).

**Requires:** Redis running

**Usage:**
```bash
npm run cache:warmup
```

**What it caches:**
- All roles
- All permissions  
- System settings

**Output:**
```
✓ Cached 6 roles
✓ Cached 42 permissions
✓ Cached 15 settings
```

**When to use:**
- After deployment
- After cache flush
- When starting development

---

### 9. `npm run cache:info`

Displays Redis connection status and cache statistics.

**Usage:**
```bash
npm run cache:info
```

**Output:**
```
✓ Connected to Redis
  Host: 127.0.0.1
  Port: 6379
  Database: 0

Cache Statistics:
  Total Keys: 156
  Memory Used: 2.4 MB
  Hit Rate: 87.3%
```

---

### 10. `npm run cache:flush`

**DANGER:** Clears ALL cached data from Redis.

**Usage:**
```bash
npm run cache:flush
```

**Confirmation required:** Yes

**When to use:**
- After major data structure changes
- When debugging cache issues
- Before re-warming cache

**After flush:** Run `npm run cache:warmup` to restore common data

---

## Common Workflows

### Daily Development (Laragon Users)

```bash
# Start everything
npm run dev:laragon

# Or start separately
npm run laragon:start    # Terminal 1
npm run watch             # Terminal 2
```

### Daily Development (PHP in PATH)

```bash
# Start everything
npm run dev

# Or start separately
npm start                 # Terminal 1
npm run watch             # Terminal 2
```

### Production Build

```bash
# Build optimized CSS
npm run build

# Warmup cache
npm run cache:warmup
```

### Cache Management

```bash
# Check cache status
npm run cache:info

# Warmup after deployment
npm run cache:warmup

# Clear cache if needed
npm run cache:flush
npm run cache:warmup
```

### CSS Development Only

```bash
# Start PHP server manually
php -S localhost:8000 -t public/

# Watch CSS in another terminal
npm run dev:simple
```

---

## Adding PHP to System PATH (Windows)

If you prefer using `npm start` instead of `npm run laragon:start`:

### Option 1: Laragon-managed PATH

1. **Open Laragon**
2. **Menu** → **Tools** → **Path** → **Add Laragon to Path**
3. **Restart terminal/VSCode**

### Option 2: Manual PATH Setup

1. **Open System Environment Variables:**
   - Windows Key → Search "environment variables"
   - Click "Edit the system environment variables"
   - Click "Environment Variables" button

2. **Edit PATH:**
   - Under "System variables", find "Path"
   - Click "Edit"
   - Click "New"
   - Add: `D:\laragon\bin\php\php-8.5.0-Win32-vs16-x64`
   - Click OK on all dialogs

3. **Restart terminal/VSCode**

4. **Verify:**
   ```bash
   php -v
   # Should output: PHP 8.5.0 ...
   ```

---

## Troubleshooting

### `'php' is not recognized...`

**Solution 1:** Use Laragon-specific scripts:
```bash
npm run laragon:start
# or
npm run dev:laragon
```

**Solution 2:** Add PHP to PATH (see section above)

**Solution 3:** Run PHP directly:
```bash
php -S localhost:8000 -t public/
```

---

### `'concurrently' not found`

**Install dependencies:**
```bash
npm install
```

---

### `Redis connection failed`

**Ensure Redis is running:**

**Laragon:**
- Open Laragon
- Click "Redis" button to start

**Standalone Redis:**
```bash
redis-server
```

**Verify:**
```bash
npm run cache:info
```

---

### CSS Changes Not Reflecting

1. **Check if watch is running:**
   ```bash
   npm run watch
   # or
   npm run dev
   ```

2. **Hard refresh browser:**
   - `Ctrl + Shift + R` (Windows/Linux)
   - `Cmd + Shift + R` (Mac)

3. **Clear CSS cache:**
   ```bash
   npm run build
   ```

---

### Port 8000 Already in Use

**Find process using port:**
```bash
netstat -ano | findstr :8000
```

**Kill process:**
```bash
taskkill /PID <PID> /F
```

**Or use different port:**
```bash
php -S localhost:8080 -t public/
```

---

## Package Dependencies

### Production Dependencies
None (pure PHP backend)

### Development Dependencies

- `@tailwindcss/cli` (v4.1.18) - Tailwind CSS standalone CLI
- `tailwindcss` (v4.1.18) - Tailwind CSS framework
- `concurrently` (v8.2.2) - Run multiple npm scripts simultaneously

### Install/Update

```bash
# Install all dependencies
npm install

# Update dependencies
npm update

# Install specific package
npm install --save-dev <package-name>
```

---

## Related Documentation

- [Caching Guide](./CACHING_GUIDE.md) - Redis caching implementation
- [Cache Quick Reference](./CACHE_QUICK_REFERENCE.md) - Developer cheat sheet
- [README.md](../README.md) - Project overview
- [START_HERE.md](../START_HERE.md) - Getting started guide

---

## Future Enhancements

- [ ] Add `npm run test` for automated testing
- [ ] Add `npm run lint` for code quality checks
- [ ] Add `npm run migrate` for database migrations
- [ ] Add `npm run seed` for database seeding
- [ ] Add platform detection (auto-choose Laragon vs generic)
- [ ] Add `npm run deploy` for production deployment
