<?php include_once("header.tpl"); ?>

<h1 class="lead"><?php echo $this->_("booking.form.title"); ?></h1>

<?php if(isset($data["errors"]) && !empty($data["errors"])): ?>
    <div class="jumbotron bg-danger">
        <ul>
        <?php foreach($data["errors"] as $error): ?>
            <li><?php echo $error; ?></li>  
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="POST">

    <div style="overflow:hidden;">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="<?php echo $this->_("booking.form.date"); ?>" id="bookingDate" name="bookingDate" value="<?php echo (isset($data["bookingDate"])) ? $data["bookingDate"] : ""; ?>" /><br /> 
                    <div id="datetimepicker12"></div>
                </div>
                <div class="col-md-6">
                        <select class="form-control" name="bookingPerson" value="<?php echo (isset($data["bookingPerson"])) ? $data["bookingPerson"] : ""; ?>">
                            <?php for($i=1; $i<31; $i++): ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <br />                
                       <input type="text" class="form-control" placeholder="<?php echo $this->_("booking.form.name"); ?>" name="bookingName" value="<?php echo (isset($data["bookingName"])) ? $data["bookingName"] : ""; ?>" /><br />
                        <input type="text" class="form-control" placeholder="<?php echo $this->_("booking.form.email"); ?>" name="bookingEmail" value="<?php echo (isset($data["bookingEmail"])) ? $data["bookingEmail"] : ""; ?>" /><br />
                        <input type="text" class="form-control" placeholder="<?php echo $this->_("booking.form.address"); ?>" class="form-control" name="bookingAddress" value="<?php echo (isset($data["bookingAddress"])) ? $data["bookingAddress"] : ""; ?>" /><br />
                        <textarea class="form-control" placeholder="<?php echo $this->_("booking.form.comment"); ?>" name="bookingComment"><?php echo (isset($data["bookingComment"])) ? $data["bookingComment"] : ""; ?></textarea><br />
                        <input type="submit" class="btn btn-lg btn-success"  name="bookingSend" value="<?php echo $this->_("booking.form.send"); ?>" /><br />

                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker12').datetimepicker({
                    date: moment().add('1', 'hours'),
                    inline: true,
                    sideBySide: true,
                    locale: 'hu',
                    stepping: 30,
                    keepOpen: true
                });
                $("#datetimepicker12").on("dp.change", function (e) {
                    $('#bookingDate').val(moment(e.date).format('YYYY.MM.DD HH:mm:00'));
                    getList();
                });
                $('#bookingDate').val(moment($("#datetimepicker12").data("date")).format('YYYY.MM.DD HH:mm:00'));
                getList();
            });

            function getList() {
                    $.ajax({
                        url: "/gpstuner/index.php?page=reservations&date=" + $('#bookingDate').val(),
                        context: document.body
                    }).done(function(data) {
                        //console.log(data);
                        $('#reservations').html(data);
                    });
            }

        </script>
    </div>


</form>

        <div class="jumbotron">
            <div class="row">
                <div id="reservations" class="col-md-12">
                    Foglalások listája
                </div>
            </div>
        </div>

<?php include_once("footer.tpl"); ?>