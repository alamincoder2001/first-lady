<div id="transferInvoice">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <!-- <a href="" id="printIcon"><i class="fa fa-print"></i> Print</a> -->
            <a href="" v-on:click.prevent="print"><i class="fa fa-print"></i> Print</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2" id="invoiceContent">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="title">Transfer Invoice</div>
                </div>
            </div>

            <div class="row" style="padding: 15px 0;">
                <div class="col-xs-7">
                    <strong>Transfer Date: </strong> <?php echo date('d/m/Y', strtotime($transfer->transfer_date)); ?><br>
                    <strong>Transferred by: </strong> <?php echo $transfer->transfer_by_name; ?><br>
                    <strong>Transferred to: </strong> <?php echo $transfer->transfer_to_name; ?><br>
                </div>

                <div class="col-xs-5">
                    <strong>Transfer Invoice: </strong> <?php echo $transfer->transfer_invoice; ?><br>
                    <strong>Note: </strong><?php echo $transfer->note; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <table id="invoiceTable">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalQty = 0;
                            foreach ($transferDetails as $key => $product) {
                                $totalQty += $product->quantity;

                            ?>
                                <tr>
                                    <td style="text-align:right;"><?php echo $key + 1; ?></td>
                                    <td><?php echo $product->ProductCategory_Name; ?></td>
                                    <td><?php echo $product->Product_Code; ?></td>
                                    <td><?php echo $product->Product_Name; ?></td>
                                    <td style="text-align:right;"><?php echo $product->quantity; ?></td>
                                    <td style="text-align:right;"><?php echo $product->purchase_rate; ?></td>
                                    <td style="text-align:right;"><?php echo $product->total; ?></td>
                                </tr>
                            <?php }; ?>
                            <tr>
                                <td colspan="4" style="text-align:right;">Total</td>
                                <td style="text-align:right;"><?php echo $totalQty; ?></td>
                                <td></td>
                                <td style="text-align:right;"><?php echo $transfer->total_amount; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/js/vue/vue.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/axios.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/vue/vue-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

<script>
    new Vue({
        el: '#transferInvoice',
        data() {
            return {

                cart: [],
                style: null,
                companyProfile: null,
                currentBranch: null
            }
        },
        created() {
            this.setStyle();
            // this.getSales();
            // this.getCompanyProfile();
            // this.getCurrentBranch();
        },
        methods: {

            setStyle() {
                this.style = document.createElement('style');
                this.style.innerHTML = `
                .title {
                    background-color:#ebebeb;padding:3px 15px;font-size:18px;font-weight:bold;
                }
                #invoiceTable {
                    width: 100%;
                    border-collapse: collapse;
                }

                #invoiceTable th,
                #invoiceTable td {
                    padding: 3px;
                    border: 1px solid #ccc;
                }

                #invoiceTable th {
                    text-align: center;
                }

                #invoiceTable thead {
                    background-color: #edede7;
                }
            `;
                document.head.appendChild(this.style);
            },
            async print() {
                let reportContent = `
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								${document.querySelector('#invoiceContent').innerHTML}
							</div>
						</div>
                        <div class="row" style="border-bottom:1px solid #ccc;margin-bottom:5px;margin-top:100px;padding-bottom:6px;">
                            <div class="col-xs-6">
                                <span style="text-decoration:overline;">Received by</span>
                            </div>
                            <div class="col-xs-6 text-right">
                                <span style="text-decoration:overline;">Authorized by</span>
                            </div>
                            <div class="col-xs-12 text-center">
                                ** THANK YOU FOR YOUR BUSINESS **
                            </div>
                        </div>
					</div>
                    
				`;

                var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);
                reportWindow.document.write(`
					<?php $this->load->view('Administrator/reports/reportHeader.php'); ?>
				`);

                reportWindow.document.body.innerHTML += reportContent;

                if (this.searchType == '' || this.searchType == 'user') {
                    let rows = reportWindow.document.querySelectorAll('.record-table tr');
                    rows.forEach(row => {
                        row.lastChild.remove();
                    })
                }

                let invoiceStyle = reportWindow.document.createElement('style');
                invoiceStyle.innerHTML = this.style.innerHTML;
                reportWindow.document.head.appendChild(invoiceStyle);

                reportWindow.focus();
                await new Promise(resolve => setTimeout(resolve, 1000));
                reportWindow.print();
                reportWindow.close();
            }
        }
    })
</script>