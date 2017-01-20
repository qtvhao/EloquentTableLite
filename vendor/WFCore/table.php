<table <?php /** @var \WFCore\WFCollection $collection */
if ($collection->eloquentTableAttributes): ?><?php echo $collection->eloquentTableAttributes; ?><?php else: ?> class="table table-striped" <?php endif; ?>>
    <thead>
    <tr>

        <?php $__currentLoopData = $collection->eloquentTableColumns;
        foreach ($__currentLoopData as $key => $name):
            ?>

            <th <?php echo $collection->getHiddenColumnAttributes($key); ?>>
                <?php if (in_array($key, $collection->eloquentTableSort)): ?>

                    <?php echo sortableUrlLink($name, array('field' => $key, 'sort' => 'asc')); ?>

                <?php elseif (array_key_exists($key, $collection->eloquentTableSort)): ?>

                    <?php echo sortableUrlLink($name, array('field' => $collection->eloquentTableSort[$key], 'sort' => 'asc')); ?>

                <?php else: ?>

                    <?php echo e(ucfirst($name)); ?>

                <?php endif; ?>
            </th>
        <?php endforeach; ?>
    </tr>
    </thead>

    <tbody>

    <?php $__currentLoopData = $collection;
    foreach ($__currentLoopData as $record):
        ?>
        <tr <?php echo $collection->getRowAttributes($record); ?>>

            <?php $__currentLoopData = $collection->eloquentTableColumns;
            foreach ($__currentLoopData as $key => $name):
                ?>

                <td <?php echo $collection->getCellAttributes($key, $record); ?>>

                    <?php if (array_key_exists($key, $collection->eloquentTableMeans)): ?>

                        <?php if (array_key_exists($key, $collection->eloquentTableModifications)): ?>
                            <?php echo call_user_func_array($collection->eloquentTableModifications[$key], array(
                                $record->getRelationshipObject($collection->eloquentTableMeans[$key]), $record
                            )); ?>

                        <?php else: ?>

                            <?php echo $record->getRelationshipProperty($collection->eloquentTableMeans[$key]); ?>

                        <?php endif; ?>
                    <?php else: ?>

                        <?php if (array_key_exists($key, $collection->eloquentTableModifications)): ?>
                            <?php echo call_user_func_array($collection->eloquentTableModifications[$key], array($record)); ?>

                        <?php else: ?>

                            <?php if ($record->{$key}): ?>

                                <?php echo $record->{$key}; ?>

                            <?php else: ?>

                                <?php echo $record->{$name}; ?>

                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            <?php endforeach;
            ?>
        </tr>
    <?php endforeach;
    ?>
    </tbody>
</table>