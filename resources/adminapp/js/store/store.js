import Vue from 'vue'
import Vuex from 'vuex'

import Alert from './modules/alert'
import I18NStore from './modules/i18n'

import PermissionsIndex from './cruds/Permissions'
import PermissionsSingle from './cruds/Permissions/single'
import RolesIndex from './cruds/Roles'
import RolesSingle from './cruds/Roles/single'
import UsersIndex from './cruds/Users'
import UsersSingle from './cruds/Users/single'
import CategoriesIndex from './cruds/Categories'
import CategoriesSingle from './cruds/Categories/single'
import BlogsIndex from './cruds/Blogs'
import BlogsSingle from './cruds/Blogs/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    Alert,
    I18NStore,
    PermissionsIndex,
    PermissionsSingle,
    RolesIndex,
    RolesSingle,
    UsersIndex,
    UsersSingle,
    CategoriesIndex,
    CategoriesSingle,
    BlogsIndex,
    BlogsSingle
  },
  strict: debug
})
