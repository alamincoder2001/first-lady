<style>
.rhcolor {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    position: relative;
    min-height: 38px;
    /* background: repeat-x #f7f7f7; */
    /* background-image: -webkit-linear-gradient(top,#FFF 0,#EEE 100%); */
    background-image: -o-linear-gradient(top, #FFF 0, #EEE 100%);
    background-image: linear-gradient(to bottom, #f5dcdc 0, #EEE 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffeeeeee', GradientType=0);
    color: #669FC7;
    border-bottom: 1px solid #DDD;
    padding-left: 12px;
}

.v-select {
    margin-bottom: 5px;
}

.v-select .dropdown-toggle {
    padding: 0px;
}

.v-select input[type=search],
.v-select input[type=search]:focus {
    margin: 0px;
}

.v-select .vs__selected-options {
    overflow: hidden;
    flex-wrap: nowrap;
}

.v-select .selected-tag {
    margin: 2px 0px;
    white-space: nowrap;
    position: absolute;
    left: 0px;
}

.v-select .vs__actions {
    margin-top: -5px;
}

.v-select .dropdown-menu {
    width: auto;
    overflow-y: auto;
}

#branchDropdown .vs__actions button {
    display: none;
}

#branchDropdown .vs__actions .open-indicator {
    height: 15px;
    margin-top: 7px;
}
</style>

<div id="sales" class="row">
    <div class="col-xs-12 col-md-12 col-lg-12" style="border-bottom:1px #ccc solid;margin-bottom:5px;">
        <div class="row">
            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right"> Invoice no </label>
                <div class="col-sm-2">
                    <input type="text" id="invoiceNo" class="form-control" v-model="sales.invoiceNo" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right"> Sales By </label>
                <div class="col-sm-2">
                    <v-select v-bind:options="employees" v-model="selectedEmployee" label="Employee_Name"
                        placeholder="Select Employee"></v-select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right"> Sales From </label>
                <div class="col-sm-2">
                    <v-select id="branchDropdown" v-bind:options="branches" label="Brunch_name" v-model="selectedBranch"
                        disabled></v-select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3">
                    <input class="form-control" type="date" v-model="sales.salesDate"
                        v-bind:disabled="userType == 'u' ? true : false" />
                    <!-- <input type="text" id="datepicker" class="form-control" v-model="sales.salesDate" v-bind:disabled="userType == 'u' ? true : false" /> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-sm-1 control-label no-padding-right"> Bill no </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" placeholder="Bill no" v-model="sales.SaleMaster_Bill_no" />
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-9">
        <div class="row">
            <div class="col-12">
                <div class="widget-box ">
                    <div class="widget-header">
                        <h4 class="widget-title">Sales Information</h4>
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>

                            <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group clearfix" style="margin-bottom: 8px;">
                                        <label class="col-xs-4 control-label no-padding-right"> Sales Type </label>
                                        <div class="col-xs-8">
                                            <input type="radio" name="salesType" value="retail"
                                                v-model="sales.salesType" v-on:change="onSalesTypeChange"> Retail &nbsp;
                                            <input type="radio" name="salesType" value="wholesale"
                                                v-model="sales.salesType" v-on:change="onSalesTypeChange"> Wholesale
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-4 control-label no-padding-right"> Customer </label>
                                        <div class="col-xs-7">
                                            <v-select v-bind:options="customers" label="display_name"
                                                v-model="selectedCustomer" v-on:input="customerOnChange"></v-select>
                                        </div>
                                        <div class="col-xs-1" style="padding: 0;">
                                            <a href="<?= base_url('customer') ?>" class="btn btn-xs btn-danger"
                                                style="height: 25px; border: 0; width: 27px; margin-left: -10px;"
                                                target="_blank" title="Add New Customer"><i class="fa fa-plus"
                                                    aria-hidden="true" style="margin-top: 5px;"></i></a>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display:none;"
                                        v-bind:style="{display: selectedCustomer.Customer_Type == 'G' ? '' : 'none'}">
                                        <label class="col-xs-4 control-label no-padding-right"> Name </label>
                                        <div class="col-xs-8">
                                            <input type="text" id="customerName" placeholder="Customer Name"
                                                class="form-control" v-model="selectedCustomer.Customer_Name"
                                                v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? false : true" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-4 control-label no-padding-right"> Mobile No </label>
                                        <div class="col-xs-8">
                                            <input type="text" id="mobileNo" placeholder="Mobile No"
                                                class="form-control" v-model="selectedCustomer.Customer_Mobile"
                                                v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? false : true" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-4 control-label no-padding-right"> Address </label>
                                        <div class="col-xs-8">
                                            <textarea id="address" placeholder="Address" class="form-control"
                                                v-model="selectedCustomer.Customer_Address"
                                                v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? false : true"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <form v-on:submit.prevent="addToCart">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Product </label>
                                            <div class="col-xs-8">
                                                <v-select id="product" v-bind:options="products"
                                                    v-model="selectedProduct" label="display_text"
                                                    v-on:input="productOnChange"></v-select>
                                            </div>
                                            <div class="col-xs-1" style="padding: 0;">
                                                <a href="<?= base_url('product') ?>" class="btn btn-xs btn-danger"
                                                    style="height: 25px; border: 0; width: 27px; margin-left: -10px;"
                                                    target="_blank" title="Add New Product"><i class="fa fa-plus"
                                                        aria-hidden="true" style="margin-top: 5px;"></i></a>
                                            </div>
                                        </div>

                                        <div class="form-group" style="display: none;">
                                            <label class="col-xs-3 control-label no-padding-right"> Brand </label>
                                            <div class="col-xs-9">
                                                <input type="text" id="brand" placeholder="Group"
                                                    class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Sale Rate </label>
                                            <div class="col-xs-9">
                                                <input type="number" id="salesRate" placeholder="Rate" step="0.01"
                                                    class="form-control" ref="rate"
                                                    v-model="selectedProduct.Product_SellingPrice"
                                                    v-on:input="productTotal" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Quantity </label>
                                            <div class="col-xs-9">
                                                <input type="number" step="0.01" id="quantity" placeholder="Qty"
                                                    class="form-control" ref="quantity"
                                                    v-model="selectedProduct.quantity" v-on:input="productTotal"
                                                    autocomplete="off" required />
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:none;">
                                            <label class="col-xs-3 control-label no-padding-right"> Discount</label>
                                            <div class="col-xs-9">
                                                <span>(%)</span>
                                                <input type="text" id="productDiscount" placeholder="Discount"
                                                    class="form-control" style="display: inline-block; width: 90%" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Amount </label>
                                            <div class="col-xs-9">
                                                <input type="text" id="productTotal" placeholder="Amount"
                                                    class="form-control" v-model="selectedProduct.total" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> </label>
                                            <div class="col-xs-9">
                                                <button type="submit" class="btn btn-default pull-right">Add to
                                                    Cart</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-sm-2">
                                    <div style="display:none;"
                                        v-bind:style="{display:sales.isService == 'true' ? 'none' : ''}">
                                        <div class="text-center" style="display:none;"
                                            v-bind:style="{color: productStock > 0 ? 'green' : 'red', display: selectedProduct.Product_SlNo == '' ? 'none' : ''}">
                                            {{ productStockText }}</div class="text-center">

                                        <input type="text" id="productStock" v-model="productStock" readonly
                                            style="border:none;font-size:20px;width:100%;text-align:center;color:green"><br>
                                        <input type="text" id="stockUnit" v-model="selectedProduct.Unit_Name" readonly
                                            style="border:none;font-size:12px;width:100%;text-align: center;"><br><br>
                                    </div>
                                    <input type="password" ref="productPurchaseRate"
                                        v-model="selectedProduct.Product_Purchase_Rate"
                                        v-on:mousedown="toggleProductPurchaseRate"
                                        v-on:mouseup="toggleProductPurchaseRate" readonly
                                        title="Purchase rate (click & hold)"
                                        style="font-size:12px;width:100%;text-align: center;">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="color:#000;margin-bottom: 5px;">
                            <thead>
                                <tr class="">
                                    <th style="width:10%;color:#000;">Sl</th>
                                    <th style="width:15%;color:#000;">Product Code</th>
                                    <th style="width:20%;color:#000;">Product Name</th>
                                    <th style="width:15%;color:#000;">Category</th>
                                    <th style="width:7%;color:#000;">Qty</th>
                                    <th style="width:8%;color:#000;">Rate</th>
                                    <th style="width:15%;color:#000;">Total Amount</th>
                                    <th style="width:10%;color:#000;">Action</th>
                                </tr>
                            </thead>
                            <tbody style="display:none;" v-bind:style="{display: cart.length > 0 ? '' : 'none'}">
                                <tr v-for="(product, sl) in cart">
                                    <td>{{ sl + 1 }}</td>
                                    <td>{{ product.productCode }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.categoryName }}</td>
                                    <td>{{ product.quantity }}</td>
                                    <td>{{ product.salesRate }}</td>
                                    <td>{{ product.total }}</td>
                                    <td><a href="" v-on:click.prevent="removeFromCart(sl)"><i
                                                class="fa fa-trash"></i></a></td>
                                </tr>

                                <tr style="font-weight: bold">
                                    <td style="text-align:right" colspan="4">Total = </td>
                                    <td style="text-align:center">
                                        {{ cart.reduce((prev,curr)=> {return prev + +curr.quantity},0) }} </td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                    <td style="text-align:center"></td>
                                </tr>

                                <tr>
                                    <td colspan="8"></td>
                                </tr>

                                <tr style="font-weight: bold;">
                                    <td colspan="5">Note</td>
                                    <td colspan="3">Total</td>
                                </tr>

                                <tr>
                                    <td colspan="5"><textarea style="width: 100%;font-size:13px;" placeholder="Note"
                                            v-model="sales.note"></textarea></td>
                                    <td colspan="3" style="padding-top: 15px;font-size:18px;">
                                        {{ cart.reduce((prev,curr)=> {return prev + +curr.total},0) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="checkbox" id="isReturn" value="isReturn" v-model="isReturn"> <label for="isReturn">is
                    Return</label>
            </div>
            <div class="col-12" style="display: none" :style="{display:isReturn ? '' : 'none'}">
                <div class="widget-box ">
                    <div class="widget-header rhcolor">
                        <h4 class="widget-title">Return Information</h4>
                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>

                            <a href="#" data-action="close">
                                <i class="ace-icon fa fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body" style="background:#fff6f6">
                        <div class="widget-main">
                            <div class="row">
                                <div class="col-sm-5">
                                    <form v-on:submit.prevent="addToCartReturn">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Product </label>
                                            <div class="col-xs-9">
                                                <v-select id="returnProduct" v-bind:options="returnProducts"
                                                    v-model="selectedReturnProduct" label="display_text"
                                                    v-on:input="returnProductOnChange"></v-select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Sale Rate </label>
                                            <div class="col-xs-9">
                                                <input type="number" id="salesRate" placeholder="Rate" step="0.01"
                                                    class="form-control" ref="rate"
                                                    v-model="selectedReturnProduct.Product_SellingPrice"
                                                    v-on:input="productReturnTotal" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Quantity </label>
                                            <div class="col-xs-9">
                                                <input type="number" step="0.01" id="returnQuantity" placeholder="Qty"
                                                    class="form-control" ref="returnQuantity"
                                                    v-model="selectedReturnProduct.quantity"
                                                    v-on:input="productReturnTotal" autocomplete="off" required />
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> Amount </label>
                                            <div class="col-xs-9">
                                                <input type="text" id="productTotal" placeholder="Amount"
                                                    class="form-control" v-model="selectedReturnProduct.total"
                                                    readonly />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-3 control-label no-padding-right"> </label>
                                            <div class="col-xs-9">
                                                <button type="submit" class="btn btn-default pull-right">Add to
                                                    Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-7">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="color:#000;margin-bottom: 5px;">
                                            <thead>
                                                <tr class="">
                                                    <th style="width:3%;color:#000;">Sl</th>
                                                    <th style="width:20%;color:#000;">Product Name</th>
                                                    <th style="width:3%;color:#000;">Qty</th>
                                                    <th style="width:2%;color:#000;">Rate</th>
                                                    <th style="width:6%;color:#000;">Total Amount</th>
                                                    <th style="width:0%;color:#000;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody style="display:none;"
                                                v-bind:style="{display: returnCart.length > 0 ? '' : 'none'}">
                                                <tr v-for="(product, sl) in returnCart">
                                                    <td>{{ sl + 1 }}</td>
                                                    <td>{{ product.productCode }} - {{ product.name }}</td>
                                                    <td>{{ product.quantity }}</td>
                                                    <td>{{ product.salesRate }}</td>
                                                    <td>{{ product.total }}</td>
                                                    <td><a href="" v-on:click.prevent="removeFromReturnCart(sl)"><i
                                                                class="fa fa-trash"></i></a></td>
                                                </tr>

                                                <tr style="font-weight: bold">
                                                    <td style="text-align:right" colspan="2">Total = </td>
                                                    <td style="text-align:center">
                                                        {{ returnCart.reduce((prev,curr)=> {return prev + +curr.quantity},0) }}
                                                    </td>
                                                    <td style="text-align:center"></td>
                                                    <td style="text-align:center"></td>
                                                    <td style="text-align:center"></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="6"></td>
                                                </tr>

                                                <tr style="font-weight: bold;">
                                                    <td colspan="3">Note</td>
                                                    <td colspan="3">Total</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3"><textarea style="width: 100%;font-size:13px;"
                                                            placeholder="Note" v-model="sales.returnNote"></textarea>
                                                    </td>
                                                    <td colspan="3" style="padding-top: 15px;font-size:18px;">
                                                        {{ returnCart.reduce((prev,curr)=> {return prev + +curr.total},0) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="widget-title">Amount Details</h4>
                <div class="widget-toolbar">
                    <a href="#" data-action="collapse">
                        <i class="ace-icon fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close">
                        <i class="ace-icon fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table style="color:#000;margin-bottom: 0px;border-collapse: collapse;">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Sub
                                                    Total</label>
                                                <div class="col-xs-12">
                                                    <input type="number" id="subTotal" class="form-control"
                                                        v-model="sales.subTotal" readonly />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Return
                                                    Total</label>
                                                <div class="col-xs-12">
                                                    <input type="number" id="returnTotal" class="form-control"
                                                        v-model="sales.returnTotal" readonly />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right"> Vat </label>
                                                <div class="col-xs-12">
                                                    <input type="number" id="vat" readonly="" class="form-control"
                                                        v-model="sales.vat" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Discount
                                                    Tk</label>

                                                <!-- <div class="col-xs-4">
													<input type="number" id="discountPercent" class="form-control" v-model="discountPercent" v-on:input="calculateTotal" />
												</div> -->

                                                <!-- <label class="col-xs-1 control-label no-padding-right">%</label> -->

                                                <div class="col-xs-12">
                                                    <input type="number" id="discount" class="form-control"
                                                        v-model="sales.discount" v-on:input="calculateTotal" />
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Transport
                                                    Cost</label>
                                                <div class="col-xs-12">
                                                    <input type="number" class="form-control"
                                                        v-model="sales.transportCost" v-on:input="calculateTotal" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="display:none;">
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Round Of</label>
                                                <div class="col-xs-12">
                                                    <input type="number" id="roundOf" class="form-control" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Total</label>
                                                <div class="col-xs-12">
                                                    <input type="number" id="total" class="form-control"
                                                        v-model="sales.total" readonly />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label no-padding-right">Paid</label>
                                                <div class="col-xs-12">
                                                    <input type="number" id="paid" class="form-control"
                                                        v-model="sales.paid" v-on:input="calculateTotal"
                                                        v-bind:disabled="selectedCustomer.Customer_Type == 'G' ? true : false" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label no-padding-right">Payment
                                                    Type</label>
                                                <div class="col-sm-12">
                                                    <select name="payment_type" id="payment_type"
                                                        v-model="sales.payment_type" class="form-control"
                                                        style="padding: 1px;">
                                                        <option value="cash">Cash</option>
                                                        <option value="bank">Bank</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="display: none;"
                                        :style="{display: sales.payment_type == 'bank' ? '' : 'none'}">
                                        <td>
                                            <div class="form-group">
                                                <label class="col-sm-12 control-label no-padding-right">Bank
                                                    Account</label>
                                                <div class="col-sm-12">
                                                    <v-select v-bind:options="accounts" v-model="account"
                                                        label="display_text" placeholder="Select account"></v-select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label class="col-xs-12 control-label">Due</label>
                                                <div class="col-xs-6">
                                                    <input type="number" id="due" class="form-control"
                                                        v-model="sales.due" readonly />
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="number" id="previousDue" class="form-control"
                                                        v-model="sales.previousDue" readonly style="color:red;" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-xs-6">
                                                    <input type="button" class="btn btn-default btn-sm" value="Sale"
                                                        v-on:click="saveSales"
                                                        v-bind:disabled="saleOnProgress ? true : false"
                                                        style="color: black!important;margin-top: 0px;width:100%;padding:5px;font-weight:bold;">
                                                </div>
                                                <div class="col-xs-6">
                                                    <a class="btn btn-info btn-sm"
                                                        v-bind:href="`/sales/${sales.isService == 'true' ? 'service' : 'product'}`"
                                                        style="color: black!important;margin-top: 0px;width:100%;padding:5px;font-weight:bold;">New
                                                        Sale</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
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
Vue.component('v-select', VueSelect.VueSelect);
new Vue({
    el: '#sales',
    data() {
        return {
            sales: {
                salesId: parseInt('<?php echo $salesId; ?>'),
                invoiceNo: '<?php echo $invoice; ?>',
                SaleMaster_Bill_no: '',
                salesBy: '<?php echo $this->session->userdata("FullName"); ?>',
                salesType: 'retail',
                salesFrom: '',
                // salesDate: '',
                // salesDate: moment(new Date()).format("DD/MM/YYYY"),
                salesDate: moment().format("YYYY-MM-DD"),
                customerId: '',
                employeeId: null,
                subTotal: 0.00,
                returnTotal: 0.00,
                discount: 0.00,
                vat: 0.00,
                transportCost: 0.00,
                total: 0.00,
                paid: 0.00,
                previousDue: 0.00,
                due: 0.00,
                isService: '<?php echo $isService; ?>',
                note: '',
                returnNote: '',
                payment_type: '',
                account_id: '',
            },
            isReturn: '',
            vatPercent: 0,
            discountPercent: 0,
            cart: [],
            returnCart: [],
            employees: [],
            selectedEmployee: null,
            branches: [],
            selectedBranch: {
                brunch_id: "<?php echo $this->session->userdata('BRANCHid'); ?>",
                Brunch_name: "<?php echo $this->session->userdata('Brunch_name'); ?>"
            },
            customers: [],
            selectedCustomer: {
                Customer_SlNo: '',
                Customer_Code: '',
                Customer_Name: '',
                display_name: 'Select Customer',
                Customer_Mobile: '',
                Customer_Address: '',
                Customer_Type: ''
            },
            oldCustomerId: null,
            oldPreviousDue: 0,
            products: [],
            selectedProduct: {
                Product_SlNo: '',
                display_text: 'Select Product',
                Product_Name: '',
                Unit_Name: '',
                quantity: 0,
                Product_Purchase_Rate: '',
                Product_SellingPrice: 0.00,
                vat: 0.00,
                total: 0.00
            },
            returnProducts: [],
            selectedReturnProduct: {
                Product_SlNo: '',
                display_text: 'Select Product',
                Product_Name: '',
                Unit_Name: '',
                quantity: 0,
                Product_Purchase_Rate: '',
                Product_SellingPrice: 0.00,
                vat: 0.00,
                total: 0.00
            },
            accounts: [],
            account: {
                account_id: ''
            },
            productPurchaseRate: '',
            productStockText: '',
            productStock: '',
            saleOnProgress: false,
            sales_due_on_update: 0,
            userType: '<?php echo $this->session->userdata("accountType"); ?>'
        }
    },
    async created() {
        // this.sales.salesDate = moment().format('DD/MM/YYYY');
        await this.getEmployees();
        await this.getBranches();
        await this.getCustomers();
        this.getProducts();
        this.getAccounts();
        // this.updateDate();

        if (this.sales.salesId != 0) {
            await this.getSales();
        }
    },
    // computed: {
    // 	newDate() {
    // 		return moment(this.sales.salesDate).format("DD/MM/YYYY");
    // 	}
    // },
    watch: {
        isReturn(value) {
            if (value == true) {
                this.getReturnProduct();
            }
        }
    },
    methods: {
        // updateDate() {
        // 	var date = new Date();
        // 	console.log(date);
        // 	var month = date.getMonth() + 1;
        // 	console.log(month);
        // 	var day = date.getDate();
        // 	console.log(day);
        // 	var year = date.getFullYear();
        // 	console.log(year);
        // 	let newDate = day + "/" + month + "/" + year;
        // 	this.sales.salesDate = newDate;
        // },
        getAccounts() {
            axios.get('/get_bank_accounts')
                .then(res => {
                    this.accounts = res.data.map((account, display_text) => {
                        account.display_text =
                            `${account.account_name} - ${account.account_number} (${account.bank_name})`;
                        return account;
                    });
                })
        },
        getEmployees() {
            axios.get('/get_employees').then(res => {
                this.employees = res.data;
            })
        },
        getBranches() {
            axios.get('/get_branches').then(res => {
                this.branches = res.data;
            })
        },
        async getCustomers() {
            await axios.post('/get_customers', {
                customerType: this.sales.salesType
            }).then(res => {
                this.customers = res.data;
                this.customers.unshift({
                    Customer_SlNo: 'C01',
                    Customer_Code: '',
                    Customer_Name: '',
                    display_name: 'General Customer',
                    Customer_Mobile: '',
                    Customer_Address: '',
                    Customer_Type: 'G'
                })
            })
        },
        getProducts() {
            axios.post('/get_products', {
                isService: this.sales.isService
            }).then(res => {
                if (this.sales.salesType == 'wholesale') {
                    this.products = res.data.filter((product) => product.Product_WholesaleRate > 0);
                    this.products.map((product) => {
                        return product.Product_SellingPrice = product.Product_WholesaleRate;
                    })
                } else {
                    this.products = res.data;
                }
            })
        },
        getReturnProduct() {
            axios.get('/get_products', {}).then(res => {
                this.returnProducts = res.data;
            })
        },
        productTotal() {
            this.selectedProduct.total = (parseFloat(this.selectedProduct.quantity) * parseFloat(this
                .selectedProduct.Product_SellingPrice)).toFixed(2);
        },
        productReturnTotal() {
            this.selectedReturnProduct.total = (parseFloat(this.selectedReturnProduct.quantity) * parseFloat(
                this.selectedReturnProduct.Product_SellingPrice)).toFixed(2);
        },
        onSalesTypeChange() {
            this.selectedCustomer = {
                Customer_SlNo: '',
                Customer_Code: '',
                Customer_Name: '',
                display_name: 'Select Customer',
                Customer_Mobile: '',
                Customer_Address: '',
                Customer_Type: ''
            }
            this.getCustomers();

            this.clearProduct();
            this.getProducts();
        },
        async customerOnChange() {
            if (this.selectedCustomer.Customer_SlNo == '') {
                return;
            }
            if (event.type == 'readystatechange') {
                return;
            }

            if (this.sales.salesId != 0 && this.oldCustomerId != parseInt(this.selectedCustomer
                    .Customer_SlNo)) {
                let changeConfirm = confirm(
                    'Changing customer will set previous due to current due amount. Do you really want to change customer?'
                );
                if (changeConfirm == false) {
                    return;
                }
            } else if (this.sales.salesId != 0 && this.oldCustomerId == parseInt(this.selectedCustomer
                    .Customer_SlNo)) {
                this.sales.previousDue = this.oldPreviousDue;
                return;
            }

            await this.getCustomerDue();

            this.calculateTotal();
        },
        async getCustomerDue() {
            await axios.post('/get_customer_due', {
                customerId: this.selectedCustomer.Customer_SlNo
            }).then(res => {
                if (res.data.length > 0) {
                    this.sales.previousDue = res.data[0].dueAmount;
                } else {
                    this.sales.previousDue = 0;
                }
            })
        },
        async productOnChange() {

            if ((this.selectedProduct.Product_SlNo != '' || this.selectedProduct.Product_SlNo != 0) && this
                .sales.isService == 'false') {
                this.productStock = await axios.post('/get_product_stock', {
                    productId: this.selectedProduct.Product_SlNo
                }).then(res => {
                    return res.data;
                })

                this.productStockText = this.productStock > 0 ? "Available Stock" : "Stock Unavailable";
                this.$refs.quantity.focus();
            }
        },
        async returnProductOnChange() {

            if (this.selectedReturnProduct.Product_SlNo != '') {
                // this.productStock = await axios.post('/get_product_stock', {
                // 	productId: this.selectedProduct.Product_SlNo
                // }).then(res => {
                // 	return res.data;
                // })

                // this.productStockText = this.productStock > 0 ? "Available Stock" : "Stock Unavailable";
                this.$refs.returnQuantity.focus();
            }
        },
        toggleProductPurchaseRate() {
            //this.productPurchaseRate = this.productPurchaseRate == '' ? this.selectedProduct.Product_Purchase_Rate : '';
            this.$refs.productPurchaseRate.type = this.$refs.productPurchaseRate.type == 'text' ? 'password' :
                'text';
        },

        addToCart() {
            let product = {
                productId: this.selectedProduct.Product_SlNo,
                productCode: this.selectedProduct.Product_Code,
                categoryName: this.selectedProduct.ProductCategory_Name,
                name: this.selectedProduct.Product_Name,
                salesRate: this.selectedProduct.Product_SellingPrice,
                vat: this.selectedProduct.vat,
                quantity: this.selectedProduct.quantity,
                total: this.selectedProduct.total,
                purchaseRate: this.selectedProduct.Product_Purchase_Rate
            }

            if (product.productId == '') {
                alert('Select Product');
                return;
            }

            if (product.quantity == 0 || product.quantity == '') {
                alert('Enter quantity');
                return;
            }

            if (product.salesRate == 0 || product.salesRate == '') {
                alert('Enter sales rate');
                return;
            }

            if (product.quantity > this.productStock && this.sales.isService == 'false') {
                alert('Stock unavailable');
                return;
            }

            let cartInd = this.cart.findIndex(p => p.productId == product.productId);
            if (cartInd > -1) {
                this.cart.splice(cartInd, 1);
            }

            this.cart.unshift(product);
            this.clearProduct();
            this.calculateTotal();
            let productSearchBox = document.querySelector('#product input[role="combobox"]');
            productSearchBox.focus();
        },
        addToCartReturn() {
            let product = {
                productId: this.selectedReturnProduct.Product_SlNo,
                productCode: this.selectedReturnProduct.Product_Code,
                name: this.selectedReturnProduct.Product_Name,
                salesRate: this.selectedReturnProduct.Product_SellingPrice,
                // vat: this.selectedReturnProduct.vat,
                quantity: this.selectedReturnProduct.quantity,
                total: this.selectedReturnProduct.total,
                purchaseRate: this.selectedReturnProduct.Product_Purchase_Rate
            }

            if (product.productId == '') {
                alert('Select Product');
                return;
            }

            if (product.quantity == 0 || product.quantity == '') {
                alert('Enter quantity');
                return;
            }

            if (product.salesRate == 0 || product.salesRate == '') {
                alert('Enter sales rate');
                return;
            }

            let cartInd = this.returnCart.findIndex(p => p.productId == product.productId);
            if (cartInd > -1) {
                this.returnCart.splice(cartInd, 1);
            }

            this.returnCart.unshift(product);
            this.clearReturnProduct();
            this.calculateTotal();
            let productSearchBox = document.querySelector('#returnProduct input[role="combobox"]');
            productSearchBox.focus();
        },
        removeFromCart(ind) {
            let conf = confirm('Are you sure to remove cart item?');
            if (conf) {
                this.cart.splice(ind, 1);
                this.calculateTotal();
            }
        },
        removeFromReturnCart(ind) {
            let conf = confirm('Are you sure to remove cart item?');
            if (conf) {
                this.returnCart.splice(ind, 1);
                this.calculateTotal();
            }
        },
        clearProduct() {
            this.selectedProduct = {
                Product_SlNo: '',
                display_text: 'Select Product',
                Product_Name: '',
                Unit_Name: '',
                quantity: 0,
                Product_Purchase_Rate: '',
                Product_SellingPrice: 0.00,
                vat: 0.00,
                total: 0.00
            }
            this.productStock = '';
            this.productStockText = '';
        },

        clearReturnProduct() {
            this.selectedReturnProduct = {
                Product_SlNo: '',
                display_text: 'Select Product',
                Product_Name: '',
                Unit_Name: '',
                quantity: 0,
                Product_Purchase_Rate: '',
                Product_SellingPrice: 0.00,
                vat: 0.00,
                total: 0.00
            }
        },
        calculateTotal() {
            let returnAmount = 0;
            if (this.returnCart.length > 0) {
                returnAmount = this.returnCart.reduce((prev, curr) => {
                    return prev + +curr.total
                }, 0).toFixed(2)
            }
            this.sales.returnTotal = returnAmount;
            this.sales.subTotal = this.cart.reduce((prev, curr) => {
                return prev + parseFloat(curr.total)
            }, 0).toFixed(2);

            this.sales.vat = this.cart.reduce((prev, curr) => {
                return +prev + +(curr.total * (curr.vat / 100))
            }, 0);
            if (event.target.id == 'discountPercent') {
                this.sales.discount = (((parseFloat(this.sales.subTotal) * parseFloat(this.discountPercent)) /
                    100)).toFixed(2);
            } else {
                this.discountPercent = (parseFloat(this.sales.discount) / parseFloat(this.sales.subTotal) * 100)
                    .toFixed(2);
            }
            let sTotal = ((parseFloat(this.sales.subTotal) + parseFloat(this.sales.vat) + parseFloat(this.sales
                .transportCost) / 100) - parseFloat(this.sales.discount) / 100).toFixed(2);

            this.sales.total = (sTotal - returnAmount).toFixed(2)

            if (this.selectedCustomer.Customer_Type == 'G') {
                this.sales.paid = this.sales.total * 100;
                this.sales.due = 0;
            } else {
                if (event.target.id != 'paid') {
                    this.sales.paid = 0;
                }
                this.sales.due = (parseFloat(this.sales.total) - parseFloat(this.sales.paid) / 100).toFixed(2);
            }
        },
        // calculateReturnTotal() {

        // },
        async saveSales() {

            if (this.selectedCustomer.Customer_SlNo == '') {
                alert('Select Customer');
                return;
            }
            // if (this.sales.SaleMaster_Bill_no == '') {
            // 	alert('Bill no is empty!');
            // 	return;
            // }
            if (this.cart.length == 0 && this.returnCart.length == 0) {
                alert('Cart is empty');
                return;
            }
            if (this.sales.payment_type == '') {
                alert('Select a Payment Type');
                return;
            }
            if (this.sales.payment_type == 'bank' && this.account.account_id == '') {
                alert('Select a Bank Account');
                return;
            }

            this.sales.account_id = this.account.account_id

            // this.saleOnProgress = true;

            await this.getCustomerDue();

            let url = "/add_sales";
            if (this.sales.salesId != 0) {
                url = "/update_sales";
                this.sales.previousDue = parseFloat((this.sales.previousDue - this.sales_due_on_update))
                    .toFixed(2);
            }

            if (parseFloat(this.selectedCustomer.Customer_Credit_Limit) < (parseFloat(this.sales.due) +
                    parseFloat(this.sales.previousDue))) {
                alert(`Customer credit limit (${this.selectedCustomer.Customer_Credit_Limit}) exceeded`);
                this.saleOnProgress = false;
                return;
            }

            if (this.selectedEmployee != null && this.selectedEmployee.Employee_SlNo != null) {
                this.sales.employeeId = this.selectedEmployee.Employee_SlNo;
            } else {
                this.sales.employeeId = null;
            }

            this.sales.customerId = this.selectedCustomer.Customer_SlNo;
            this.sales.salesFrom = this.selectedBranch.brunch_id;

            let data = {
                sales: this.sales,
                cart: this.cart,
                returnCart: this.returnCart
            }

            if (this.selectedCustomer.Customer_Type == 'G') {
                data.customer = this.selectedCustomer;
            }

            // console.log(data);
            // return;

            let conf = confirm('Are you sure to save sale?');
            if (conf) {
                axios.post(url, data).then(async res => {
                    let r = res.data;
                    if (r.success) {
                        let conf = confirm('Sale success, Do you want to view invoice?');
                        if (conf) {
                            window.open('/sale_invoice_print/' + r.salesId, '_blank');
                            await new Promise(r => setTimeout(r, 1000));
                            window.location = this.sales.isService == 'false' ?
                                '/sales/product' : '/sales/service';
                        } else {
                            window.location = this.sales.isService == 'false' ?
                                '/sales/product' : '/sales/service';
                        }
                    } else {
                        alert(r.message);
                        this.saleOnProgress = false;
                    }
                })
            }
        },
        async getSales() {
            await axios.post('/get_sales', {
                salesId: this.sales.salesId
            }).then(res => {
                let r = res.data;
                let sales = r.sales[0];
                this.sales.salesBy = sales.AddBy;
                this.sales.SaleMaster_Bill_no = sales.SaleMaster_Bill_no;
                this.sales.salesFrom = sales.SaleMaster_branchid;
                this.sales.salesDate = sales.SaleMaster_SaleDate;
                this.sales.salesType = sales.SaleMaster_SaleType;
                this.sales.customerId = sales.SalseCustomer_IDNo;
                this.sales.employeeId = sales.Employee_SlNo;
                this.sales.subTotal = sales.SaleMaster_SubTotalAmount;
                this.sales.discount = sales.SaleMaster_TotalDiscountAmount * 100;
                this.sales.vat = sales.SaleMaster_TaxAmount;
                this.sales.returnTotal = sales.SaleMaster_ReturnAmount;
                this.sales.transportCost = sales.SaleMaster_Freight * 100;
                this.sales.total = sales.SaleMaster_TotalSaleAmount;
                this.sales.paid = sales.SaleMaster_PaidAmount * 100;
                this.sales.previousDue = sales.SaleMaster_Previous_Due;
                this.sales.due = sales.SaleMaster_DueAmount;
                this.sales.note = sales.SaleMaster_Description;
                this.sales.payment_type = sales.payment_type;
                this.sales.account_id = sales.account_id;

                this.oldCustomerId = sales.SalseCustomer_IDNo;
                this.oldPreviousDue = sales.SaleMaster_Previous_Due;
                this.sales_due_on_update = sales.SaleMaster_DueAmount;

                this.vatPercent = parseFloat(this.sales.vat) * 100 / parseFloat(this.sales
                    .subTotal);
                this.discountPercent = parseFloat(this.sales.discount) * 100 / parseFloat(this.sales
                    .subTotal);

                this.selectedEmployee = {
                    Employee_SlNo: sales.employee_id,
                    Employee_Name: sales.Employee_Name
                }

                this.selectedCustomer = {
                    Customer_SlNo: sales.SalseCustomer_IDNo,
                    Customer_Code: sales.Customer_Code,
                    Customer_Name: sales.Customer_Name,
                    display_name: sales.Customer_Type == 'G' ? 'General Customer' :
                        `${sales.Customer_Code} - ${sales.Customer_Name}`,
                    Customer_Mobile: sales.Customer_Mobile,
                    Customer_Address: sales.Customer_Address,
                    Customer_Type: sales.Customer_Type
                }

                r.saleDetails.forEach(product => {
                    let cartProduct = {
                        productCode: product.Product_Code,
                        productId: product.Product_IDNo,
                        categoryName: product.ProductCategory_Name,
                        name: product.Product_Name,
                        salesRate: product.SaleDetails_Rate,
                        vat: product.SaleDetails_Tax,
                        quantity: product.SaleDetails_TotalQuantity,
                        total: product.SaleDetails_TotalAmount,
                        purchaseRate: product.Purchase_Rate,
                    }

                    this.cart.push(cartProduct);
                })
                if (sales.payment_type == 'bank') {
                    setTimeout(() => {
                        this.account = this.accounts.find(item => item.account_id == sales
                            .account_id);
                    }, 500);
                }

                let gCustomerInd = this.customers.findIndex(c => c.Customer_Type == 'G');
                this.customers.splice(gCustomerInd, 1);

                if (sales.SaleMaster_ReturnAmount > 0) {
                    this.isReturn = true
                    r.salesReturn.forEach(rproduct => {
                        let product = {
                            productId: rproduct.SaleReturnDetailsProduct_SlNo,
                            productCode: rproduct.Product_Code,
                            name: rproduct.Product_Name,
                            quantity: rproduct.SaleReturnDetails_ReturnQuantity,
                            salesRate: rproduct.SaleReturnDetails_ReturnAmount/rproduct.SaleReturnDetails_ReturnQuantity,
                            total: rproduct.SaleReturnDetails_ReturnAmount,
                            purchaseRate: rproduct,
                        }

                        this.returnCart.unshift(product);
                    })

                }
            })
        }
    }
})
</script>