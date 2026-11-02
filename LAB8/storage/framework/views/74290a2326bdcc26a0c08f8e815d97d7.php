<?php $__env->startSection('title', 'Sign In'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Sign In</h1>
    <p>Enter your email and password.</p>

    <form method="POST" action="<?php echo e(route('login.store')); ?>">
        <?php echo csrf_field(); ?>

        <label for="email">Email</label>
        <input
            id="email"
            type="email"
            name="email"
            value="<?php echo e(old('email')); ?>"
            autocomplete="username"
            required
        >

        <label for="password">Password</label>
        <input
            id="password"
            type="password"
            name="password"
            autocomplete="current-password"
            required
        >

        <button type="submit">Sign In</button>
    </form>

    <p>
        Need an account?
        <a href="<?php echo e(route('register')); ?>">Sign up</a>
    </p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\hw\laraWebIT\resources\views/auth/login.blade.php ENDPATH**/ ?>