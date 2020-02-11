<!-- Notifications Modal -->
<spark-notifications
    :notifications="notifications"
    :has-unread-announcements="hasUnreadAnnouncements"
    :loading-notifications="loadingNotifications" inline-template>

    <div>
        <div class="modal docked docked-right" id="modal-notifications" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <div class="relative inline-flex align-middle">
                            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-grey-lightest-lightest bg-grey-lightest hover:bg-grey-lightest-light" :class="{'active': showingNotifications}" @click="showNotifications" style="width: 50%;">
                                {{__('Notifications')}}
                            </button>

                            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-grey-lightest-lightest bg-grey-lightest hover:bg-grey-lightest-light" :class="{'active': showingAnnouncements}" @click="showAnnouncements" style="width: 50%;">
                                {{__('Announcements')}} <i class="fa fa-circle text-red" v-if="hasUnreadAnnouncements"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-body">
                        <!-- Informational Messages -->
                        <div class="notification-container" v-if="loadingNotifications">
                            <div><i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Loading Notifications')}}</div>
                        </div>

                        <div class="notification-container" v-if=" ! loadingNotifications && activeNotifications.length == 0">
                            <div class="relative px-3 py-3 mb-4 border rounded text-yellow-darker border-yellow-dark bg-yellow-lighter">
                                {{__('We don\'t have anything to show you right now! But when we do, we\'ll be sure to let you know. Talk to you soon!')}}
                            </div>
                        </div>

                        <!-- List Of Notifications -->
                        <div class="notification-container" v-if="showingNotifications && hasNotifications">
                            <div class="notification" v-for="notification in notifications.notifications">

                                <!-- Notification Icon -->
                                <figure>
                                    <img v-if="notification.creator" :src="notification.creator.photo_url" class="spark-profile-photo" alt="{{__('Creator Photo')}}" />

                                    <span v-else class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i :class="['fa', 'fa-stack-1x', 'fa-inverse', notification.icon]"></i>
                                    </span>
                                </figure>

                                <!-- Notification -->
                                <div class="notification-content">
                                    <div class="meta">
                                        <p class="title">
                                            <span v-if="notification.creator">
                                                @{{ notification.creator.name }}
                                            </span>

                                            <span v-else>
                                                {{ Spark::product() }}
                                            </span>
                                        </p>

                                        <div class="date">
                                            @{{ notification.created_at | relative }}
                                        </div>
                                    </div>

                                    <div class="notification-body" v-html="notification.parsed_body"></div>

                                    <!-- Notification Action -->
                                    <a :href="notification.action_url" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" v-if="notification.action_text">
                                        @{{ notification.action_text }}
                                    </a>

                                </div>
                            </div>
                        </div>

                        <!-- List Of Announcements -->
                        <div class="notification-container" v-if="showingAnnouncements && hasAnnouncements">
                            <div class="notification" v-for="announcement in notifications.announcements">

                                <!-- Notification Icon -->
                                <figure>
                                    <img :src="announcement.creator.photo_url" class="spark-profile-photo" alt="{{__('Creator Photo')}}" />
                                </figure>

                                <!-- Announcement -->
                                <div class="notification-content">
                                    <div class="meta">
                                        <p class="title">@{{ announcement.creator.name }}</p>

                                        <div class="date">
                                            @{{ announcement.created_at | relative }}
                                        </div>
                                    </div>

                                    <div class="notification-body" v-html="announcement.parsed_body"></div>

                                    <!-- Announcement Action -->
                                    <a :href="announcement.action_url" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" v-if="announcement.action_text">
                                        @{{ announcement.action_text }}
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('absolute pin-t pin-b pin-r px-4 py-3')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-notifications>
