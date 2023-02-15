<?php

include_once "./include/header.php";
$cities=["East london", "Cate Town","Germistom","Johannesburg", "Pretoria", "Durban", "Bloemfontein", "Poet Elizabeth", "Modimolle", "Polokwane", "Rustenburg"];

?>

<h2 class="text-center" style="margin-top: 20px"> Your Home Services</h2>
<hr>
<div class="container" style="margin-top:20px; margin-bottom: 60px;">

     <div class="row">
        <div class="form-group col-5">
            <label for="">City</label>
            <select class="form-control" name="city" id="city">
                <option value="none"> -- select city --</option>
                <?php foreach ($cities as $city): ?>
                <option value="<?= $citiy ?>"> <?= $city ?>
                </option> 
                <?php endforeach; ?>

            </select>    
        </div>

        <div class="form-group col-5">
            <label for="">Who is required</label>
            <select class="form-control" name="profession" id="prefession">
                <option value="cleaning">Home Cleaning</option>
                <option value="furniture">Furniture Assembly</option>
                <option value="handyman">Handyman</option>
                <option value="office">Office Cleaning</option>
                        

            </select>
        </div>

        <div class="form-group col-2">
            <label for="">Action</label>
            <button id="search" class="form-control btn-success" type="button">search</button>
        </div>

    </div>

    <div class="table-responsive">
        <table id="providers" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Profession</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='5'>Select city and profession</td>
                </tr>
            <tbody>
            </table>
    </div>
</div>
<script src="js/jquery.js"></script>
<script>
    $(function() {
        $("#search").click(function() {
            var city = $("#city").val();
            var profession = $("#profession").val();

            if (city == "none" || profession == "none") {
                alert("Don't leave fields empty!");
                tbody = "<tr><td colspan='5'>please </td></tr>";
            } else {
                $.post('scripts/searchproviders.php', {
                    city: city,
                    profession: profession
                }, function(res) {
                    var providers = JSON.parse(res);
                    var tbody = "";

                    if (providers.failed == true) {
                        tbody = "<tr><td colspan='5'>No Service Providers found...</td></tr>";
                    } else {
                        providers.forEach(function(provider, i) {
                            tbody += "<tr>" +
                                "<td><img style='height:150px' src='images/" + provider
                                .photo +
                                "'/></td>" +
                                "<td>" + provider.name + "</td>" +
                                "<td>" + provider.adder1 + ",<br>" + provider.adder2 +
                                ",<br>" +
                                provider.city + "</td>" +
                                "<td>" + provider.profession + "</td>" +
                                "<td><a href='booking.php?provider=" + provider.id +
                                "' class='btn btn-primary btn-block'>Book</a></td>";
                        });
                    }
                    $("#providers tbody").html(tbody);
                });
            }
        });
    });
</script>

<?php include_once "./include/footer.php";   




