<section class="card details">
    <h2>Course Details</h2>

    <dl class="detail-grid">
        <dt>Course Code</dt>
        <dd><?php echo e($viewing->course_code); ?></dd>

        <dt>Course Name</dt>
        <dd><?php echo e($viewing->course_name); ?></dd>

        <dt>Credit Hours</dt>
        <dd><?php echo e($viewing->credit_hours); ?></dd>

        <dt>Semester</dt>
        <dd><?php echo e($viewing->semester); ?></dd>

        <dt>Registered On</dt>
        <dd><?php echo e($viewing->created_at->format('d M Y, H:i')); ?></dd>
    </dl>

    <div class="actions">
        <a class="btn btn-primary"
           href="<?php echo e(route('courses.edit', $viewing->id)); ?>">
            Edit This Course
        </a>

        <a class="btn btn-neutral" href="<?php echo e(route('dashboard')); ?>">
            Close Details
        </a>
    </div>
</section>
<?php /**PATH D:\hw\laraWebIT\resources\views/courses/details.blade.php ENDPATH**/ ?>