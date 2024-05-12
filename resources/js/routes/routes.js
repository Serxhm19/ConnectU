import Cookies from 'js-cookie'
import store from "../store";

const AuthenticatedLayout = () => import('../layouts/Authenticated.vue')
const GuestLayout = () => import('../layouts/Guest.vue');

const PostsIndex = () => import('../views/admin/posts/Index.vue');
const PostsCreate = () => import('../views/admin/posts/Create.vue');
const PostsEdit = () => import('../views/admin/posts/Edit.vue');
const ExercisesIndex = () => import('../views/admin/exercises/Index.vue');
const ExercisesCreate = () => import('../views/admin/exercises/Create.vue');
const ExercisesEdit = () => import('../views/admin/exercises/Edit.vue');

/*---------------------------------------------------------------------------------//
const EventList  = ()  => import('../views/event/index.vue');
const EventCreate  = ()  => import('../views/event/create.vue');
const EventUpdate  = ()  => import('../views/event/update.vue');
//---------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------------//
const GroupList  = ()  => import('../views/group/index.vue');
const GroupCreate  = ()  => import('../views/group/create.vue');
const GroupUpdate  = ()  => import('../views/group/update.vue');
//---------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------------//
const PromoterList  = ()  => import('../views/promoter/index.vue');
const PromoterCreate  = ()  => import('../views/promoter/create.vue');
const PromoterUpdate  = ()  => import('../views/promoter/update.vue'); 
//---------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------------//
const CategoryEventList  = ()  => import('../views/categoryEvent/index.vue');
const CategoryEventCreate  = ()  => import('../views/categoryEvent/create.vue');
const CategoryEventUpdate  = ()  => import('../views/categoryEvent/update.vue');
//---------------------------------------------------------------------------------*/

//const ChatList  = ()  => import('../views/admin/chat/index.vue');
//const ChatView  = ()  => import('../views/admin/chat/chat.vue');
/*---------------------------------------------------------------------------------//
const GroupUserList  = ()  => import('../views/groupUser/index.vue');
const GroupUserCreate  = ()  => import('../views/groupUser/create.vue');
const GroupUserUpdate  = ()  => import('../views/groupUser/update.vue');
//---------------------------------------------------------------------------------*/


function requireLogin(to, from, next) {
    let isLogin = false;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next()
    } else {
        next('/')
    }
}

function guest(to, from, next) {
    let isLogin;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next('/')
    } else {
        next()
    }
}

export default [
    {
        path: '/',
        // redirect: { name: 'login' },
        component: GuestLayout,
        children: [

            {
                path: '/',
                name: 'home',
                component: () => import('../views/home/index.vue'),
                meta: {
                    hideHeader: true,
                },
            },
            {
                path: 'posts',
                name: 'public-posts.index',
                component: () => import('../views/posts/index.vue'),
            },
            {
                path: 'event/:id',
                name: 'publi-event.event',
                component: () => import('../views/event/event.vue'),
            },
            {
                path: 'posts/:id',
                name: 'public-posts.details',
                component: () => import('../views/posts/details.vue'),
            },
            {
                path: 'category/:id',
                name: 'category-posts.index',
                component: () => import('../views/category/posts.vue'),
            },
            {
                path: 'register',
                name: 'auth.register',
                component: () => import('../views/register/index.vue'),
                beforeEnter: guest,
                meta: {
                    hideHeader: true,
                },
            },
            {
                path: 'forgot-password',
                name: 'auth.forgot-password',
                component: () => import('../views/auth/passwords/Email.vue'),
                beforeEnter: guest,
            },
            {
                path: 'reset-password/:token',
                name: 'auth.reset-password',
                component: () => import('../views/auth/passwords/Reset.vue'),
                beforeEnter: guest,
            },
            {
                name: 'chats',
                path: 'chats',
                meta: { breadCrumb: 'Chats' },
                beforeEnter: requireLogin,
                children: [
                    {
                        name: 'chats.index',
                        path: '',
                        component: () => import('../views/chat/index.vue'),
                        meta: { breadCrumb: 'Chats' }
                    }
                ]
            }

        ]
    },
    {
        path: '/admin',
        component: AuthenticatedLayout,
        // redirect: {
        //     name: 'admin.index'
        // },
        beforeEnter: requireLogin,
        meta: { breadCrumb: 'Dashboard' },
        children: [
            {
                name: 'admin.index',
                path: '',
                component: () => import('../views/admin/index.vue'),
                meta: { breadCrumb: 'Admin' }
            },
            {
                name: 'profile.index',
                path: 'profile',
                component: () => import('../views/admin/profile/index.vue'),
                meta: { breadCrumb: 'Profile' }
            },

            {
                name: 'events',
                path: 'events',
                meta: { breadCrumb: 'events' },
                children: [
                    {
                        name: 'events.create',
                        path: 'create',
                        component: () => import('../views/admin/events/create.vue'),
                        meta: { breadCrumb: 'Create' }
                    },
                    {
                        name: 'events.update',
                        path: 'edit/:id',
                        component: () => import('../views/admin/events/Edit.vue'),
                        meta: { breadCrumb: 'Edit' }
                    },
                ]
            },
            {
                name: 'calendar.calendar',
                path: 'calendar',
                component: () => import('../views/admin/calendar/calendar.vue'),
                meta: { breadCrumb: 'Calendar' }
            },
            {
                name: 'account',
                path: 'account',
                component: () => import('../views/admin/account/account.vue'),
                meta: { breadCrumb: 'Account' }
            },
            {
                name: 'posts.index',
                path: 'posts',
                component: PostsIndex,
                meta: { breadCrumb: 'Posts' }
            },
            {
                name: 'posts.create',
                path: 'posts/create',
                component: PostsCreate,
                meta: { breadCrumb: 'Add new post' }
            },
            {
                name: 'posts.edit',
                path: 'posts/edit/:id',
                component: PostsEdit,
                meta: { breadCrumb: 'Edit post' }
            },
            {
                name: 'exercises',
                path: 'exercises',
                meta: { breadCrumb: 'Exercises' },
                children: [
                    {
                        name: 'exercises.index',
                        path: '',
                        component: ExercisesIndex,
                        meta: { breadCrumb: 'View' }
                    },
                    {
                        name: 'exercises.create',
                        path: 'create',
                        component: ExercisesCreate,
                        meta: {
                            breadCrumb: 'Add new exercise',
                            linked: false,
                        }
                    },
                    {
                        name: 'exercises.edit',
                        path: 'edit/:id',
                        component: ExercisesEdit,
                        meta: {
                            breadCrumb: 'Edit exercise',
                            linked: false,
                        }
                    }
                ]
            },

            {
                name: 'categories',
                path: 'categories',
                meta: { breadCrumb: 'Categories' },
                children: [
                    {
                        name: 'categories.index',
                        path: '',
                        component: () => import('../views/admin/categories/Index.vue'),
                        meta: { breadCrumb: 'View category' }
                    },
                    {
                        name: 'categories.create',
                        path: 'create',
                        component: () => import('../views/admin/categories/Create.vue'),
                        meta: {
                            breadCrumb: 'Add new category',
                            linked: false,
                        }
                    },
                    {
                        name: 'categories.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/categories/Edit.vue'),
                        meta: {
                            breadCrumb: 'Edit category',
                            linked: false,
                        }
                    }
                ]
            },


            {
                name: 'permissions',
                path: 'permissions',
                meta: { breadCrumb: 'Permisos' },
                children: [
                    {
                        name: 'permissions.index',
                        path: '',
                        component: () => import('../views/admin/permissions/Index.vue'),
                        meta: { breadCrumb: 'Permissions' }
                    },
                    {
                        name: 'permissions.create',
                        path: 'create',
                        component: () => import('../views/admin/permissions/Create.vue'),
                        meta: {
                            breadCrumb: 'Create Permission',
                            linked: false,
                        }
                    },
                    {
                        name: 'permissions.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/permissions/Edit.vue'),
                        meta: {
                            breadCrumb: 'Permission Edit',
                            linked: false,
                        }
                    }
                ]
            },

            //TODO Organizar rutas
            {
                name: 'roles.index',
                path: 'roles',
                component: () => import('../views/admin/roles/Index.vue'),
                meta: { breadCrumb: 'Roles' }
            },
            {
                name: 'roles.create',
                path: 'roles/create',
                component: () => import('../views/admin/roles/Create.vue'),
                meta: { breadCrumb: 'Create Role' }
            },
            {
                name: 'roles.edit',
                path: 'roles/edit/:id',
                component: () => import('../views/admin/roles/Edit.vue'),
                meta: { breadCrumb: 'Role Edit' }
            },
            {
                name: 'users.index',
                path: 'users',
                component: () => import('../views/admin/users/Index.vue'),
                meta: { breadCrumb: 'Users' }
            },
            {
                name: 'users.create',
                path: 'users/create',
                component: () => import('../views/admin/users/Create.vue'),
                meta: { breadCrumb: 'Add New' }
            },
            {
                name: 'users.edit',
                path: 'users/edit/:id',
                component: () => import('../views/admin/users/Edit.vue'),
                meta: { breadCrumb: 'User Edit' }
            },
        ]
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import("../views/errors/404.vue"),
    },
];
