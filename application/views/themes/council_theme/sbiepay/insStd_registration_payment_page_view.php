<div class="panel-heading" style="
                                            height: 45px;
                                            font-size: 18px;
                                            background-color: #00a65a;
                                            color: #fff;
                                            display: flex;
                                        ">
    <span class="glyphicon glyphicon-circle-arrow-right" style="padding: 2px;"></span>
    Student NAME :
    <p style="
                                                position: relative;
                                                left: 5px;
                                                font-weight: bolder;
                                                font-family: monospace;
                                                font-size: 22px;
                                                bottom: 3px;
                                                color: #141313;
                                            ">
        <?php echo $details['candidate_name']?>
        
    </p>


</div>
<div class="panel-body">

    <table class="table table-striped table-condensed">
        <thead>
            <tr style="font-size: 18px;">
                <th>Description</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="col-md-9">Registration Fee</td>
                <td class="col-md-3"><i class="fa fa-inr"></i>
                <?php echo $details['total_amount'];?></td>
            </tr>
            
            <tr>
                <td class="text-right">
                    <h2><strong>Total: </strong></h2>
                </td>
                <td class="text-left text-danger">
                    <h2><strong><i class="fa fa-inr"></i>
                            <?php echo $details['total_amount'];?></strong></h2>
                </td>
            </tr>
        </tbody>
    </table>


</div>