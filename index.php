<?php
require_once './includes/header.php';
?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6 mx-auto">
            <div class="card border-secondary">
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Titer
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $database->getNotes();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
require_once './includes/footer.php';
?>