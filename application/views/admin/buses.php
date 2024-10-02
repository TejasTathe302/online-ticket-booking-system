<?php if(isset($det)){ ?>
<div class="container">
    <form action="<?= base_url() ?>admin/save_edited_bus" method="POST">
        <div class="row">
            <div class="col-12">
                <h3 class="p-4 fw-bold">Edit Bus</h3>
            </div>
            <div class="col-1">
                <input type="hidden" name="buses_tbl_id" value="<?=$det[0]['buses_tbl_id']?>">
            </div>
            <div class="col-4">
                <label for=""> Bus Name : </label>
                <input type="text" class="form-control" name="bus_name" placeholder="Enter Bus Name" value='<?=$det[0]['bus_name']?>'>
            </div>
            <div class="col-6">
                <label for=""> Bus Description : </label>
                <textarea name="bus_desc" class="form-control"><?=$det[0]['bus_desc']?></textarea>
            </div>
            <div class="col-12 text-center p-3">
                <button class="btn btn-success">Update Bus</button>
            </div>
            <div class="col-2"> </div>
        </div>
    </form>
</div>
<?php }else{ ?>
<div class="container">
    <form action="<?= base_url() ?>admin/save_bus" method="POST">
        <div class="row">
            <div class="col-12">
                <h3 class="p-4 fw-bold">Add Bus</h3>
            </div>
            <div class="col-1">
            </div>
            <div class="col-4">
                <label for=""> Bus Name : </label>
                <input type="text" class="form-control" name="bus_name" placeholder="Enter Bus Name">
            </div>
            <div class="col-6">
                <label for=""> Bus Description : </label>
                <textarea name="bus_desc" class="form-control"></textarea>
            </div>
            <div class="col-12 text-center p-3">
                <button class="btn btn-success">Add Bus</button>
            </div>
            <div class="col-2"> </div>
        </div>
    </form>
</div>
<?php } ?>
<div class="container mt-5">
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="p-4 fw-bold">List Of Buses</h3>
        </div>
    </div>
    <div class="col-12">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Action</th>
                    <th>Sr. No</th>
                    <th>Bus Name</th>
                    <th>Bus Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($buses as $key => $value) {
                ?>
                    <tr>
                        <td class="text-center">
                            <a href="<?=base_url()?>admin/delete_bus/<?=$value['buses_tbl_id']?>" onclick="return confirm('Are you sure...?')"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                            <a href="<?=base_url()?>admin/edit_bus/<?=$value['buses_tbl_id']?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button></a>
                        </td>
                        <td class="text-center"><?=$key+1?></td>
                        <td class="text-center"><?=$value['bus_name']?></td>
                        <td class="text-center"><?=$value['bus_desc']?></td>
                    </tr>
                <?php } ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>