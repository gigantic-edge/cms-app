<!DOCTYPE html>
<html lang="en">

<head>
    <?= $head; ?>
</head>

<body class="d-flex flex-column vh-100">
    <div class="d-flex flex-grow-1 flex-column flex-lg-row">
        <!-- Sidebar -->
            <?= $sidebar; ?>
        <!-- Sidebar -->
        <!-- Main content -->
        <div class="flex-grow-1 d-flex flex-column">
            <header class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center sticky-top border-bottom">
                <?= $header; ?>
            </header>
            <main class="flex-grow-1 overflow-auto p-4">
                <?= $maincontent; ?>
            </main>
        </div>
        <!-- Main content -->
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white py-3 text-center small mt-auto">
        <?= $footer; ?>
    </footer>
    <!-- Footer -->
</body>

</html>