<section class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4 position-relative">
                <div class="p-3 text-center">
                    <?php $inbox = 0; ?>
                    <h1 class="text-gradient text-primary"><span id="state1" countto="70"><?= number_format($inbox) ?></span></h1>
                    <h5 class="mt-3">Inbox</h5>
                    <p class="text-lg h2 font-weight-normal text-dark"><span style="font-size:3rem" class="material-icons">mail</span></p>
                </div>
                <hr class="vertical dark">
            </div>
            <div class="col-md-4 position-relative">
                <div class="p-3 text-center">
                    <?php $sent = 0; ?>
                    <h1 class="text-gradient text-primary"><span id="state1" countto="70"><?= number_format($inbox) ?></span></h1>
                    <h5 class="mt-3">Sent</h5>
                    <p class="text-lg h2 font-weight-normal text-info"><span style="font-size:3rem" class="material-icons">send</span></p>
                </div>
                <hr class="vertical dark">
            </div>
            <div class="col-md-4 position-relative">
                <div class="p-3 text-center">
                    <h1 class="text-gradient text-primary"><span id="state1" countto="70"><?= number_format($unread) ?></span></h1>
                    <h5 class="mt-3">Unread</h5>
                    <p class="text-lg h2 font-weight-normal text-primary"><span style="font-size:3rem" class="material-icons">mark_email_unread</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-1">
    <div class="container">
        <h3 class="text-center fw-bolder">Welcome to <?= $_settings->info('firstname') ?> <?=$_settings->info('lastname')?></h3>
        <hr>
    </div>
</section>