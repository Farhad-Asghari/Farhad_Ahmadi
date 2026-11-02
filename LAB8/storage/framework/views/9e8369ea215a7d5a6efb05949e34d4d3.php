<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>Course Dashboard</title>
    <link rel="stylesheet"
          href="<?php echo e(asset('css/dashboard.css')); ?>">
</head>
<body>

<header class="topbar">
    <div class="container nav-row">
        <a class="brand" href="<?php echo e(route('dashboard')); ?>">
            Course Dashboard
        </a>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button class="btn btn-light" type="submit">
                Logout
            </button>
        </form>
    </div>
</header>

<main class="container page">
    <h1>Welcome, <?php echo e(auth()->user()->name); ?>!</h1>

    <p class="muted">Register and manage your own courses.</p>

    <?php if(session('success')): ?>
        <div class="notice success" role="status">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="dashboard-grid">
        <section class="card">
            <?php echo $__env->make('courses.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </section>

        <section class="card">
            <?php echo $__env->make('courses.table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </section>
    </div>

    <?php if($viewing): ?>
        <?php echo $__env->make('courses.details', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
</main>

</body>
</html>
<?php /**PATH D:\hw\laraWebIT\resources\views/dashboard.blade.php ENDPATH**/ ?>