<spark-kiosk-announcements inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Create Announcement')}}</div>

            <div class="flex-auto p-6">
                <div class="relative px-3 py-3 mb-4 border rounded text-teal-darker border-teal-dark bg-teal-lighter">
                    {{__('Announcements you create here will be sent to the "Product Announcements" section of the notifications modal window, informing your users about new features and improvements to your application.')}}
                </div>

                <form role="form">
                    <!-- Announcement -->
                    <div class="mb-4 flex flex-wrap">
                        <label for="announcement" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Announcement')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="announcement" id="announcement" rows="7" v-model="createForm.body" style="font-family: monospace;" :class="{'bg-red-dark': createForm.errors.has('body')}">
                            </textarea>

                            <span class="hidden mt-1 text-sm text-red" v-show="createForm.errors.has('body')">
                                @{{ createForm.errors.get('body') }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Text -->
                    <div class="mb-4 flex flex-wrap">
                        <label for="action_text" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Action Button Text')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="action_text" id="action_text" v-model="createForm.action_text" :class="{'bg-red-dark': createForm.errors.has('action_text')}">

                            <span class="hidden mt-1 text-sm text-red" v-show="createForm.errors.has('action_text')">
                                @{{ createForm.errors.get('action_text') }}
                            </span>
                        </div>
                    </div>

                    <!-- Action URL -->
                    <div class="mb-4 flex flex-wrap">
                        <label for="action_url" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Action Button URL')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="action_url" id="action_url" v-model="createForm.action_url" :class="{'bg-red-dark': createForm.errors.has('action_url')}">

                            <span class="hidden mt-1 text-sm text-red" v-show="createForm.errors.has('action_url')">
                                @{{ createForm.errors.get('action_url') }}
                            </span>
                        </div>
                    </div>

                    <!-- Create Button -->
                    <div class="mb-4 flex flex-wrap">
                        <div class="md:mx-1/3 md:w-1/2 pr-4 pl-4">
                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                    @click.prevent="create"
                                    :disabled="createForm.busy">

                                {{__('Create')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recent Announcements List -->
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if="announcements.length > 0">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Recent Announcements')}}</div>

            <div class="block w-full overflow-auto scrolling-touch">
                <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                    <thead>
                        <tr>
                            <th class="th-fit"></th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Announcement')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="reveal" v-for="announcement in announcements">
                            <!-- Photo -->
                            <td>
                                <img :src="announcement.creator.photo_url" class="spark-profile-photo" alt="{{__('Creator Photo')}}" />
                            </td>

                            <!-- Date -->
                            <td>
                                <div>
                                    @{{ announcement.created_at | datetime }}
                                </div>
                            </td>

                            <!-- Body -->
                            <td>
                                <div>
                                    @{{ _.truncate(announcement.body, {length: 45}) }}
                                </div>
                            </td>

                            <!-- Edit Button -->
                            <td class="td-fit">
                                <div class="reveal-target text-right">
                                    <button class="btn-reset" @click="editAnnouncement(announcement)">
                                        <svg class="icon-20 icon-sidenav " xmlns="http://www.w3.org/2000/svg ">
                                            <path fill="#95A2AE" d="M12.3 3.7L0 16v4h4L16.3 7.7l-4-4zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"></path>
                                        </svg>
                                    </button>

                                    <button class="btn-reset" @click="approveAnnouncementDelete(announcement)">
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

        <!-- Edit Announcement Modal -->
        <div class="modal" id="modal-update-announcement" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" v-if="updatingAnnouncement">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Update Announcement')}}
                        </h5>
                    </div>

                    <div class="modal-body">
                        <!-- Update Announcement -->
                        <form role="form">
                            <!-- Announcement -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Announcement')}}</label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" rows="7" v-model="updateForm.body" style="font-family: monospace;" :class="{'bg-red-dark': updateForm.errors.has('body')}">
                                    </textarea>

                                    <span class="hidden mt-1 text-sm text-red" v-show="updateForm.errors.has('body')">
                                        @{{ updateForm.errors.get('body') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Text -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Action Button Text')}}</label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="action_text" v-model="updateForm.action_text" :class="{'bg-red-dark': updateForm.errors.has('action_text')}">

                                    <span class="hidden mt-1 text-sm text-red" v-show="updateForm.errors.has('action_text')">
                                        @{{ updateForm.errors.get('action_text') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action URL -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Action Button URL')}}</label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="action_url" v-model="updateForm.action_url" :class="{'bg-red-dark': updateForm.errors.has('action_url')}">

                                    <span class="hidden mt-1 text-sm text-red" v-show="updateForm.errors.has('action_url')">
                                        @{{ updateForm.errors.get('action_url') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('absolute pin-t pin-b pin-r px-4 py-3')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click="update" :opacity-75="updateForm.busy">
                            {{__('Update')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Announcement Modal -->
        <div class="modal" id="modal-delete-announcement" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="deletingAnnouncement">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Delete Announcement')}}
                        </h5>
                    </div>

                    <div class="modal-body">
                        {{__('Are you sure you want to delete this announcement?')}}
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-lightest bg-red hover:bg-red-light" @click="deleteAnnouncement" :opacity-75="deleteForm.busy">
                            {{__('Yes, Delete')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-kiosk-announcements>
