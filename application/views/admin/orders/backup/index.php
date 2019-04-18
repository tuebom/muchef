<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <!-- <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo anchor('admin/orders/create', '<i class="fa fa-plus"></i> Create Inventory', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                </div> -->
                                <div class="box-body table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Member Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Ship to</th>
                                                <th class="text-right">Total</th>
                                                <!-- <th>Tax</th>
                                                <th>Ship Cost</th>
                                                <th>Grand Total</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($orders as $item):?>
                                            <tr>
                                            <td>#<?php echo htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->tglinput, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php 
                                                    switch ($item->status) {
                                                        case "Pending":    echo "<span class='label label-danger'>Pending</span>"; break;
                                                        case "Processing": echo "<span class='label label-warning'>Processing</span>"; break;
                                                        case "Shipped":    echo "<span class='label label-info'>Shipped</span>"; break;
                                                        case "Delivered":  echo "<span class='label label-success'>Delivered</span>"; break;
                                                    }
                                                    ?></td>
                                                <td><?php echo htmlspecialchars($item->address, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <!-- <td><?php echo htmlspecialchars($item->total, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->tax, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->shipcost, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td class="text-right"><?php echo number_format(htmlspecialchars($item->gtotal, ENT_QUOTES, 'UTF-8'),0,",","."); ?></td>
                                                <td>
                                                    <?php if ($item->status !== 'Delivered') echo anchor('admin/orders/edit/'.$item->id, 'Edit'); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer" align="center">
									<?php echo $this->data['pagination']; ?>
								</div>

                            </div>
                         </div>
                    </div>
                </section>
            </div>
