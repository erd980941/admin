<?php include '_header.php' ?>
<?php include '../_business/order.response.php' ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="row">
                    <div class="col-6" style="margin:auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Ürünler</h6>
                    </div>
                    <div class="col-6 text-end">
                            <a href="./order-list" class="btn btn-primary">
                                Tümü
                            </a>
                        <?php foreach ($enumValues as $enumValue): ?>
                            <a href="?order_status=<?php echo $enumValue ?>" class="btn btn-primary">
                                <?php echo $enumValue ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Sipariş Numarası</th>
                                <th>Kullanıcı Bilgileri</th>
                                <th>Adres Bilgileri</th>
                                <th>Toplam Tutar</th>
                                <th>Tarih</th>
                                <th>Sipariş Durumu</th>
                                <th>Ödeme</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $key => $order): ?>
                                <tr class="align-middle">
                                    <td class="text-center">
                                        <?php echo $key + 1 ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#orderDetailModal-<?php echo $key ?>">
                                            <?php echo $order['order_number'] ?>
                                        </button>
                                        <?php $orderDetails = getOrderDetails($order['order_id']); ?>
                                        <div class="modal fade " id="orderDetailModal-<?php echo $key ?>" tabindex="-1"
                                            aria-labelledby="userModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="userModalLabel">Sipariş Detayları</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <?php foreach ($orderDetails as $orderDetail): ?>
                                                                <div class="col-lg-3 col-md-6 mb-4">
                                                                    <div class="card">
                                                                        <img src="../../assets/img/products/<?php echo $orderDetail['photo_name'] ?>" class="card-img-top" alt="...">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item"><?php echo $orderDetail['product_name'] ?></li>
                                                                            <li class="list-group-item"><?php echo $orderDetail['quantity'] ?> x <?php echo number_format($orderDetail['discounted_price'], 2, ',', '.') ?> TL</li>
                                                                            <li class="list-group-item"><?php echo number_format($orderDetail['subtotal'], 2, ',', '.')  ?> TL</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#userModal">
                                            <?php echo $order['user_email'] ?>
                                        </button>
                                        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="userModalLabel">Kullanıcı Detayları</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Email:</strong> <span ><?php echo $order['user_email']; ?></span></p>
                                                            <p><strong>Ad:</strong> <span><?php echo $order['user_first_name']; ?></span></p>
                                                            <p><strong>Soyad:</strong> <span><?php echo $order['user_last_name']; ?></span></p>
                                                            <p><strong>Telefon Numarası:</strong> <span ><?php echo $order['user_phone_number']; ?></span></p>
                                                            <p>
                                                                <strong>Durum:</strong> 
                                                                <span class="<?php echo $order['user_status']?'text-success':'text-danger'; ?>" >
                                                                    <?php echo $order['user_status']?'Aktif':'Pasif'; ?>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                data-bs-target="#orderAddressModal">
                                                Adres Bilgileri
                                        </button>
                                        <?php $orderShippingInfos = getOrderShippingInfo($order['order_id']) ?>
                                        <div class="modal fade" id="orderAddressModal" tabindex="-1" aria-labelledby="orderAddressModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="userModalLabel">Kullanıcı Detayları</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <?php foreach ($orderShippingInfos as $shippingInfo): ?>
                                                                    <?php if ($shippingInfo['shipping_type'] == 'Ürün'): ?>
                                                                        <!-- Teslimat Adresi -->
                                                                        <div class="col-lg-6">
                                                                            <h6 style="color:#484848">Teslimat Adresi</h6>
                                                                            <address style="color:#484848; font-size:13px">
                                                                                <?php echo $shippingInfo['recipient_address']; ?><br>
                                                                                <?php echo $shippingInfo['recipient_district']; ?> / <?php echo $shippingInfo['recipient_city']; ?>
                                                                                - <?php echo $shippingInfo['postal_code']; ?><br>
                                                                                <b>
                                                                                    <?php echo $shippingInfo['recipient_name']; ?>
                                                                                    <?php echo $shippingInfo['recipient_surname']; ?>
                                                                                </b> - <b>
                                                                                    <?php echo $shippingInfo['phone_number']; ?>
                                                                                </b>
                                                                            </address>
                                                                        </div>
                                                                    <?php elseif ($shippingInfo['shipping_type'] == 'Fatura'): ?>
                                                                        <!-- Fatura Bilgileri -->
                                                                        <div class="col-lg-6">
                                                                            <h6 style="color:#484848">Fatura Bilgileri</h6>
                                                                            <address style="color:#484848; font-size:13px">
                                                                                <?php echo $shippingInfo['recipient_address']; ?><br>
                                                                                <?php echo $shippingInfo['recipient_district']; ?> / <?php echo $shippingInfo['recipient_city']; ?>
                                                                                 - <?php echo $shippingInfo['postal_code']; ?><br>
                                                                                <b>
                                                                                    <?php echo $shippingInfo['recipient_name']; ?>
                                                                                    <?php echo $shippingInfo['recipient_surname']; ?>
                                                                                </b> - <b>
                                                                                    <?php echo $shippingInfo['phone_number']; ?>
                                                                                </b>
                                                                                <br>
                                                                            </address>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo number_format($order['total_amount'], 2, ',', '.') ?> TL
                                    </td>
                                    <td>
                                        <?php echo $order['order_date'] ?>
                                    </td>
                                    <td>
                                    <form action="../_business/order.request.php" method="POST" >
                                        <?php if($order['order_status']=='Kargoda'): ?>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" placeholder="Kargo Numarası" name="shipping_tracking_number" value="<?php echo $order['shipping_tracking_number'] ?>" >
                                                <button class="btn btn-outline-secondary" type="submit" name="update_shipping_tracking_number" id="button-addon2">Kaydet</button>
                                                <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>" >
                                            </div>
                                        <?php endif; ?>
                                    </form>
                                    <form action="../_business/order.request.php" method="POST" >
                                        <div class="input-group">
                                            <select class="form-select" name="order_status" >
                                                <?php foreach ($enumValues as $enumValue): ?>
                                                    <option value="<?php echo $enumValue ?>" <?php echo ($enumValue === $order['order_status']) ? 'selected' : ''; ?> >
                                                        <?php echo $enumValue ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button class="btn btn-outline-secondary" type="submit" name="update_order_status" id="button-addon2">Kaydet</button>
                                            <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>" >
                                        </div>
                                    </form>                     
                                    </td>
                                    <td>
                                        <?php if($order['payment_status']): ?>
                                            <span class="btn btn-sm btn-success" >
                                                Ödendi
                                            </span>
                                        <?php else: ?>
                                            <span class="btn btn-sm btn-warning" >
                                                Ödenmedi
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a onClick="confirmDelete(<?php echo $order['order_id'] ?>)"
                                        class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> Sil</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silme Onayı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   Siparişi sildiğinizde bütüm veriler tamamen kaybolacaktır. Bu siparişi silmek istediğinize emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Sil</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(orderId) {
            $('#confirmationModal').modal('show');

            $('#confirmDeleteBtn').click(function () {
                // Kullanıcı "Sil" butonuna tıkladı, formu gönder
                window.location.href = "../_business/order.request.php?order_id=" + orderId + "&delete=true";
            });
        }


    </script>

    <?php include '_footer.php' ?>