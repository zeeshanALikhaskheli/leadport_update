    <?php 
    $totalQty = 0;
    $totalKgcalc = 0;
    $totalLdm = 0;
    $totalVolumeM3 = 0;
    ?>  
    <i class="mdi mdi-plus-circle-outline text-success font-28 addgoods"></i>
    <table class="table" id="table">
        <thead>
        <tr>
		<th>Quantity</th>
        <th width="10%">Units Type</th>
        <th>Description</th>
        <th>Weight (Br)</th>
		<th>LDM</th>
		<th>Volume (m3)</th>
		<th>Length (cm)</th>
		<th>Width (cm)</th>
		<th>Height (cm)</th>
		</tr>
        </thead>
        <tbody id="goodsTable">
        <?php $__currentLoopData = $ticket['goods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <?php 
            $totalQty += $good['quantity'];
            $totalKgcalc += $good['weight'];
            $totalLdm += $good['ldm'];
            $totalVolumeM3 += $good['volume'];
            ?>
            <tr id="<?php echo e($key); ?>">
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][quantity]"          value="<?php echo e($good['quantity']); ?>"></td>

                <td>
                    <select class="form-control" name="goods[<?php echo e($key); ?>][unit_type]" id="unit_type_<?php echo e($key); ?>">
                        <option value="roll" <?php echo e($good['unit_type'] == 'roll' ? 'selected' : ''); ?>>Roll</option>
                        <option value="pieces" <?php echo e($good['unit_type'] == 'pieces' ? 'selected' : ''); ?>>Pieces</option>
                        <option value="eur" <?php echo e($good['unit_type'] == 'eur' ? 'selected' : ''); ?>>EUR</option>
                        <option value="pallet" <?php echo e($good['unit_type'] == 'pallet' ? 'selected' : ''); ?>>Pallet</option>
                    </select>
                </td>

                <td><input type="text"   class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][description]"       value="<?php echo e($good['description']); ?>"></td>
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][weight]"            value="<?php echo e($good['weight']); ?>"></td>
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][ldm]"               value="<?php echo e($good['ldm']); ?>"></td>
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][volume]"            value="<?php echo e($good['volume']); ?>"></td>
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][length]"            value="<?php echo e($good['length']); ?>"></td>
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][width]"             value="<?php echo e($good['width']); ?>"></td>
                <td><input type="number" class="form-control"  id="<?php echo e($key); ?>"   name="goods[<?php echo e($key); ?>][height]"            value="<?php echo e($good['height']); ?>"></td>
                <td><i class="sl-icon-trash custom" onclick="removeIndex(this)"></i></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>
         <tr>
		        <td><input type="number" class="form-control" name="totalQuantity" value="<?php echo e($totalQty); ?>" disabled></td>
				<td></td>
				<td></td>
	            <td><input type="number" class="form-control" name="totalWeight" value="<?php echo e($totalKgcalc); ?>" disabled></td>
				<td><input type="number" class="form-control" name="totalLDM"    value="<?php echo e($totalLdm); ?>" disabled></td>
				<td><input type="number" class="form-control" name="totalVolume" value="<?php echo e($totalVolumeM3); ?>" disabled></td>
				<td></td>
				<td></td>
                <td></td>
			    <td></td>
		</tr>
    </table> <?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/customticket/components/misc/edit-goods.blade.php ENDPATH**/ ?>