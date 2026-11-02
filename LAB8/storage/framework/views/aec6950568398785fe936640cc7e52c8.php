<h2>My Registered Courses (<?php echo e($courses->count()); ?>)</h2>
<p class="muted">Use View, Edit, or Delete beside a course.</p>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th scope="col">Code / Course</th>
                <th scope="col">Credits</th>
                <th scope="col">Semester</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="<?php echo e($editing?->id === $course->id
                    ? 'editing-row' : ''); ?>">

                    <td>
                        <strong><?php echo e($course->course_code); ?></strong>
                        <span class="course-name">
                            <?php echo e($course->course_name); ?>

                        </span>
                    </td>

                    <td><?php echo e($course->credit_hours); ?></td>
                    <td><?php echo e($course->semester); ?></td>

                    <td>
                        <div class="actions">
                            <a class="btn btn-neutral"
                               href="<?php echo e(route('courses.show', $course->id)); ?>">
                                View
                            </a>

                            <a class="btn btn-primary"
                               href="<?php echo e(route('courses.edit', $course->id)); ?>">
                                Edit
                            </a>

                            <form method="POST"
                                  action="<?php echo e(route('courses.destroy', $course->id)); ?>"
                                  onsubmit="return confirm('Delete this course?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4">No courses registered yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php /**PATH D:\hw\laraWebIT\resources\views/courses/table.blade.php ENDPATH**/ ?>