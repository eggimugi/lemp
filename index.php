<?php
/**
 * File: index.php
 * Description: LEMP confirmation page.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Configuration Report</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            width: 100%;
            max-width: 450px;
            padding: 32px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0 0 8px;
            color: #0f172a;
        }
        p {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0 0 24px;
        }
        .status-list {
            border-top: 1px solid #f1f5f9;
            padding-top: 16px;
        }
        .status-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .label {
            color: #64748b;
            font-weight: 500;
        }
        .value {
            color: #10b981;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .footer {
            margin-top: 24px;
            font-size: 0.75rem;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Configuration Successful</h1>
        <p>The LEMP stack environment has been provisioned and is operating within normal parameters.</p>
        
        <div class="status-list">
            <div class="status-item">
                <span class="label">Web Server</span>
                <span class="value">Nginx Active</span>
            </div>
            <div class="status-item">
                <span class="label">PHP Runtime</span>
                <span class="value">PHP-FPM Active</span>
            </div>
            <div class="status-item">
                <span class="label">Database Engine</span>
                <span class="value">MySQL Ready</span>
            </div>
            <div class="status-item">
                <span class="label">System Status</span>
                <span class="value">Stable</span>
            </div>
        </div>
        
        <div class="footer">
            System Timestamp: <?php echo date('Y-m-d H:i:s T'); ?>
        </div>
    </div>
</body>
</html>