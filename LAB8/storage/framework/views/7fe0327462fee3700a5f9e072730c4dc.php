<?php $__env->startSection('title', 'Sign Up'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Sign Up</h1>
    <p>Create your student account.</p>

    <form method="POST" action="<?php echo e(route('register.store')); ?>">
        <?php echo csrf_field(); ?>

        <label for="name">Name</label>
        <input
            id="name"
            type="text"
            name="name"
            value="<?php echo e(old('name')); ?>"
            maxlength="255"
            autocomplete="name"
            required
        >

        <label for="email">Email</label>
        <input
            id="email"
            type="email"
            name="email"
            value="<?php echo e(old('email')); ?>"
            maxlength="255"
            autocomplete="email"
            required
        >

        <label for="password">Password</label>
        <input
            id="password"
            type="password"
            name="password"
            minlength="8"
            autocomplete="new-password"
            required
        >

        <label for="password_confirmation">Confirm Password</label>
        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            minlength="8"
            autocomplete="new-password"
            required
        >

        <button type="submit">Create Account</button>
    </form>

    <p>
        Already have an account?
        <a href="<?php echo e(route('login')); ?>">Sign in</a>
    </p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\hw\laraWebIT\resources\views/auth/register.blade.php ENDPATH**/ ?>