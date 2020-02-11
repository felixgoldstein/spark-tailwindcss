<spark-mailed-invitations :invitations="invitations" inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if="invitations.length > 0">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Mailed Invitations')}}</div>

            <div class="block w-full overflow-auto scrolling-touch">
                <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                    <thead>
                        <tr>
                            <th>{{__('E-Mail Address')}}</th>
                            <th class="th-fit">&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="reveal" v-for="invitation in invitations">
                            <!-- E-Mail Address -->
                            <td>
                                <div>
                                    @{{ invitation.email }}
                                </div>
                            </td>

                            <!-- Delete Button -->
                            <td class="td-fit">
                                <div class="reveal-target text-right ">
                                    <button class="btn-reset" @click="cancel(invitation)">
                                    <svg class="icon-20 icon-sidenav " xmlns="http://www.w3.org/2000/svg ">
                                        <path fill="#95A2AE " d="M4 2l2-2h4l2 2h4v2H0V2h4zM1 6h14l-1 14H2L1 6zm5 2v10h1V8H6zm3 0v10h1V8H9z"></path>
                                    </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</spark-mailed-invitations>
