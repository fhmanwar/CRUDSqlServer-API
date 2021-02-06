<button class="btn btn-outline-warning btn-sm btn-circle dataToggle" data-toggle="modal" data-placement="left" data-target="#UpdData<?php echo $row->NoteId ?>" title="Edit" ><i class="fas fa-lg fa-edit"></i></button>
<button class="btn btn-outline-danger btn-sm btn-circle dataToggle" data-toggle="modal" data-placement="right" data-target="#DelData<?php echo $row->NoteId ?>" title="Delete" ><i class="fas fa-lg fa-trash-alt"></i></button>
<!-- Update Modal -->
<div class="modal fade" id="UpdData<?php echo $row->NoteId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses.php" method="post">
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <div class="col-lg-12">
                        <font color="brown" style="font-weight:bold;font-size:16px;">Title</font>
                    </div>
                    <div class="col-lg-12">
                        <input type="hidden" name="noteId" value="<?php echo $row->NoteId ?>">
                        <input class="form-control form-group" type="text" name="title" placeholder="Input Title" value="<?php echo $row->Title ?>"/>
                    </div>
                </div>
                <div class="form-group col-lg-12">
                    <div class="col-lg-12">
                        <font color="brown" style="font-weight:bold;font-size:16px;">Describe</font>
                    </div>
                    <div class="col-lg-12">
                        <Textarea class="form-control form-group" name="desc" placeholder="Input Describe"><?php echo $row->DescNote ?></Textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-warning" name="update" >Update</button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="DelData<?php echo $row->NoteId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="proses.php" method="post">
            <div class="modal-body">
                <input type="hidden" name="noteId" value="<?php echo $row->NoteId ?>">
                <div class="form-group col-lg-12">
                    <p class="alert alert-warning">Are you sure want to delete this data?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-danger" name="delete" >Delete</button>
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->