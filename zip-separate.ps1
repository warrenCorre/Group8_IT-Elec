# zip-separate.ps1
$exclude = @('vendor', 'node_modules', '.git', 'storage/logs', 'storage/framework/sessions', '.env', '.idea', '.vscode', 'tests')
$sqlDump = "C:\Users\Michael\Desktop\laravel_db_backup.sql"
$tempDir = "$env:TEMP\laravel-temp-$(Get-Random)"
$projectZip = "..\laravel-project.zip"
$dbZip = "..\database-backup.zip"

if (Test-Path $projectZip) { Remove-Item $projectZip }
if (Test-Path $dbZip) { Remove-Item $dbZip }

Write-Host "Copying project files to temp folder..." -ForegroundColor Cyan
robocopy . $tempDir /E /XD $exclude /XF *.log /NP /NFL /NDL

Write-Host "Creating project zip (without database)..." -ForegroundColor Cyan
Compress-Archive -Path "$tempDir\*" -DestinationPath $projectZip -CompressionLevel Optimal

if (Test-Path $sqlDump) {
    Write-Host "Creating database backup zip..." -ForegroundColor Cyan
    Compress-Archive -Path $sqlDump -DestinationPath $dbZip -CompressionLevel Optimal
    Write-Host "✅ Database dump zipped." -ForegroundColor Green
} else {
    Write-Host "⚠️ SQL dump not found at $sqlDump. Please export database first." -ForegroundColor Yellow
}

Remove-Item $tempDir -Recurse -Force

Write-Host "`n🎉 Two zip files created:" -ForegroundColor Green
Write-Host "   Project: $projectZip" -ForegroundColor Cyan
Write-Host "   Database: $dbZip" -ForegroundColor Cyan
Write-Host "Size of project zip: $([math]::Round((Get-Item $projectZip).Length / 1MB, 2)) MB" -ForegroundColor Gray
if (Test-Path $dbZip) {
    Write-Host "Size of database zip: $([math]::Round((Get-Item $dbZip).Length / 1MB, 2)) MB" -ForegroundColor Gray
}
