<h2><?php echo e($editing ? 'Edit Course' : 'Register a Course'); ?></h2>
<p class="muted">Fields marked * are required.</p>

<?php if($errors->any()): ?>
    <div class="notice error" role="alert">
        <strong>Please correct the following:</strong>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST"
      action="<?php echo e($editing
          ? route('courses.update', $editing->id)
          : route('courses.store')); ?>">
    <?php echo csrf_field(); ?>

    <?php if($editing): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <div class="field">
        <label for="course_code">Course Code *</label>
        <input id="course_code" name="course_code" type="text"
               value="<?php echo e(old('course_code', $editing?->course_code)); ?>"
               maxlength="20" required>
    </div>

    <div class="field">
        <label for="course_name">Course Name *</label>
        <input id="course_name" name="course_name" type="text"
               value="<?php echo e(old('course_name', $editing?->course_name)); ?>"
               maxlength="150" required>
    </div>

    <div class="field">
        <label for="credit_hours">Credit Hours *</label>
        <input id="credit_hours" name="credit_hours" type="number"
               value="<?php echo e(old('credit_hours', $editing?->credit_hours)); ?>"
               min="1" max="6" step="1" required>
    </div>

    <div class="field">
        <label for="semester">Semester *</label>
        <select id="semester" name="semester" required>
            <option value="">Select semester</option>
            <?php $__currentLoopData = ['Spring 2026', 'Fall 2026']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($term); ?>"
                    <?php if(old('semester', $editing?->semester) === $term): echo 'selected'; endif; ?>>
                    <?php echo e($term); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="actions">
        <button class="btn btn-primary" type="submit">
            <?php echo e($editing ? 'Save Changes' : 'Register Course'); ?>

        </button>

        <?php if($editing): ?>
            <a class="btn btn-neutral" href="<?php echo e(route('dashboard')); ?>">
                Cancel
            </a>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH D:\hw\laraWebIT\resources\views/courses/form.blade.php ENDPATH**/ ?>