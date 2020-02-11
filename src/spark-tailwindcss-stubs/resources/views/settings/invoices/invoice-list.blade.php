<spark-invoice-list :user="user" :team="team"
                    :invoices="invoices" :billable-type="billableType" inline-template>

    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Invoices')}}</div>

        <div class="block w-full overflow-auto scrolling-touch">
            <table class="w-full max-w-full mb-4 bg-transparent">
                <thead>
                </thead>
                <tbody>
                <tr v-for="invoice in invoices">
                    <!-- Invoice Date -->
                    <td>
                        <strong>@{{ invoice.created_at | date }}</strong>
                    </td>

                    <!-- Invoice Total -->
                    <td>
                        @{{ invoice.total | currency }}
                    </td>

                    <!-- Invoice Download Button -->
                    <td class="text-right">
                        <a :href="downloadUrlFor(invoice)">
                            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default">
                                <i class="fa fa-btn fa-file-pdf-o"></i> {{__('Download PDF')}}
                            </button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</spark-invoice-list>
