<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container-sm">
        <form id="transfer-form">
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Bank Code</label>
                <div class="col-sm-10">
                    <input type="text" name="bankCode" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Account No</label>
                <div class="col-sm-10">
                    <input type="text" name="accountNo" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Account Type</label>
                <div class="col-sm-10">
                    <input type="text" name="accountType" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Account Name</label>
                <div class="col-sm-10">
                    <input type="text" name="accountName" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Amount</label>
                <div class="col-sm-10">
                    <input type="text" name="amount" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Fee Type</label>
                <div class="col-sm-10">
                    <input type="text" name="feeType" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Partner Ref Id</label>
                <div class="col-sm-10">
                    <input type="text" name="partnerRefId" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Message</label>
                <div class="col-sm-10">
                    <input type="text" name="message" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Customer Phone Number</label>
                <div class="col-sm-10">
                    <input type="text" name="customerPhoneNumber" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Contract Number</label>
                <div class="col-sm-10">
                    <input type="text" name="contractNumber" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Channel</label>
                <div class="col-sm-10">
                    <input type="text" name="channel" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 form-label">Bank Id</label>
                <div class="col-sm-10">
                    <input type="text" name="bankId" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('transfer-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const data = {};
                formData.forEach((value, key) => {
                    if (value != "") {
                        data[key] = value;
                    }
                });


                fetch('/api/v1/service/transfer/make', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                    .then(response => {
                        if (response.status === 200) {
                            return response.json();
                        } else if (response.status === 422) {
                            return response.json().then(data => {
                                alert(JSON.stringify(data?.errors));
                            });
                        } else {
                            return response.json().then(data => {
                                alert(data.data.message)
                            });
                        }
                    })
            });
        });
    </script>
</body>

</html>
