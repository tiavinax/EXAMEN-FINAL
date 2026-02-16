<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Gestion des dons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/assets/css/bngrc.css" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0f2f5; }
        .navbar-custom {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 1rem 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white !important;
        }
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .stat-icon {
            width: 60px; height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }
        .stat-icon.blue { background: #e8f0fe; color: #1e3c72; }
        .stat-icon.green { background: #e3fcef; color: #0b5e42; }
        .stat-icon.orange { background: #fff4e5; color: #cc7b2c; }
        .stat-icon.red { background: #ffe8e8; color: #b91c1c; }
        .stat-value { font-size: 2rem; font-weight: 700; color: #1a1f36; }
        .stat-label { color: #6b7280; font-weight: 500; font-size: 0.9rem; text-transform: uppercase; }
        .table-container {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .badge-custom {
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }
        .badge-besoin { background: #fef3c7; color: #92400e; }
        .badge-attribue { background: #d1fae5; color: #065f46; }
        .badge-reste { background: #fee2e2; color: #991b1b; }
        .btn-details {
            background: #f3f4f6;
            color: #4b5563;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-weight: 500;
        }
        .btn-details:hover { background: #1e3c72; color: white; }
        .btn-export {
            background: white;
            color: #1e3c72;
            border: 2px solid #1e3c72;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
        }
        .btn-export:hover { background: #1e3c72; color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <i class="bi bi-building fs-2 me-2"></i>
                BNGRC Madagascar
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $_SERVER['REQUEST_URI'] == '/dashboard' ? 'active' : '' ?>" href="/dashboard">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/villes">
                            <i class="bi bi-building me-1"></i> Villes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/besoins">
                            <i class="bi bi-list-check me-1"></i> Besoins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dons">
                            <i class="bi bi-gift me-1"></i> Dons
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?= $content ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>