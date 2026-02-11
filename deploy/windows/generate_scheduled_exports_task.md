# Windows Task Scheduler - Audit Export Job

This is a simple guide to create a scheduled task to run `generate_scheduled_exports.php` using Laragon's PHP on Windows.

1. Open Task Scheduler -> Create Task...
2. Name: `NexusERP - Audit Export`
3. Security options: Run whether user is logged on or not, and run with highest privileges.
4. Trigger: Daily at desired time (e.g., 04:00)
5. Action: Start a program
   - Program/script: `D:\laragon\bin\php\php-8.5.0-Win32-vs17-x64\php.exe`
   - Add arguments: `D:\laragon\www\erp-system-web\cli\generate_scheduled_exports.php`
   - Start in: `D:\laragon\www\erp-system-web\cli`
6. Conditions: uncheck 'Start the task only if the computer is on AC power' for servers.
7. OK and provide credentials.

Alternatively, create via `schtasks` CLI:

```powershell
schtasks /Create /SC DAILY /TN "NexusERP - Audit Export" /TR "D:\\laragon\\bin\\php\\php-8.5.0-Win32-vs17-x64\\php.exe D:\\laragon\\www\\erp-system-web\\cli\\generate_scheduled_exports.php" /ST 04:00 /RU "SYSTEM"
```

Notes:
- Ensure the PATHs match your installation.
- Logs will be written to stdout; redirect output to a file if desired in the action definition.
