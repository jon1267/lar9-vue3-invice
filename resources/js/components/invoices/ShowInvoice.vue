<script setup>
    import { onMounted, ref } from 'vue';

    let form = ref({ id: ''});

    const props = defineProps({
        id: {
            type: String,
            default: ''
        }
    });

    onMounted(async () => {
        await getInvoice();
    });

    const getInvoice = async () => {
        let response = await axios.get(`/api/show-invoice/${props.id}`);
        console.log('form', response.data.invoice);
        form.value = response.data.invoice;
    }

</script>

<template>
    <div class="container">

        <div class="invoices">

            <div class="card__header">
                <div>
                    <h2 class="invoice__title">Invoice</h2>
                </div>
                <div>

                </div>
            </div>
            <div>
                <div class="card__header--title ">
                    <h1 class="mr-2">#{{ form.id }}</h1>
                    <p>{{ form.created_at }}</p>
                </div>

                <div>
                    <ul  class="card__header-list">
                        <li>
                            <!-- Select Btn Option -->
                            <button class="selectBtnFlat">
                                <i class="fas fa-print"></i>
                                Print
                            </button>
                            <!-- End Select Btn Option -->
                        </li>
                        <li>
                            <!-- Select Btn Option -->
                            <button class="selectBtnFlat">
                                <i class=" fas fa-reply"></i>
                                Edit
                            </button>
                            <!-- End Select Btn Option -->
                        </li>
                        <li>
                            <!-- Select Btn Option -->
                            <button class="selectBtnFlat ">
                                <i class=" fas fa-pencil-alt"></i>
                                Delete
                            </button>
                            <!-- End Select Btn Option -->
                        </li>

                    </ul>
                </div>
            </div>

            <div class="table invoice">
                <div class="logo">
                    <img src="assets/img/logo.png" alt="" style="width: 200px;">
                </div>
                <div class="invoice__header--title">
                    <p></p>
                    <p class="invoice__header--title-1">Invoice</p>
                    <p></p>
                </div>


                <div class="invoice__header--item">
                    <div>
                        <h2>Invoice To:</h2>
                        <p v-if="form.customer">{{ form.customer.firstname }}</p>
                    </div>
                    <div>
                        <div class="invoice__header--item1">
                            <p>Invoice#</p>
                            <span>#{{ form.number }}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Date</p>
                            <span>{{ form.date }}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Due Date</p>
                            <span>{{ form.date }}</span>
                        </div>
                        <div class="invoice__header--item2">
                            <p>Reference</p>
                            <span>{{ form.reference }}</span>
                        </div>

                    </div>
                </div>

                <div class="table py1">

                    <div class="table--heading3">
                        <p>#</p>
                        <p>Item Description</p>
                        <p>Unit Price</p>
                        <p>Qty</p>
                        <p>Total</p>
                    </div>

                    <!-- item 1 -->
                    <div class="table--items3">
                        <p>1</p>
                        <p>Lorem Ipsum is simply dummy text</p>
                        <p>$ 300</p>
                        <p>1</p>
                        <p>$ 300</p>
                    </div>
                </div>

                <div  class="invoice__subtotal">
                    <div>
                        <h2>Thank you for your business</h2>
                    </div>
                    <div>
                        <div class="invoice__subtotal--item1">
                            <p>Sub Total</p>
                            <span> $ 1200</span>
                        </div>
                        <div class="invoice__subtotal--item2">
                            <p>Discount</p>
                            <span>$ 100</span>
                        </div>

                    </div>
                </div>

                <div class="invoice__total">
                    <div>
                        <h2>Terms and Conditions</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                    </div>
                    <div>
                        <div class="grand__total" >
                            <div class="grand__total--items">
                                <p>Grand Total</p>
                                <span>$ 1100</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card__footer">
                <div>

                </div>
                <div>
                    <a class="btn btn-secondary">
                        Save
                    </a>
                </div>
            </div>

        </div>

    </div>
</template>

