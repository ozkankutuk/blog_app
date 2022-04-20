<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.create') }}
                <strong>{{ $t('cruds.blog.title_singular') }}</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.category_id !== null,
                      'is-focused': activeField == 'category'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.blog.fields.category')
                    }}</label>
                    <v-select
                      name="category"
                      label="name"
                      :key="'category-field'"
                      :value="entry.category_id"
                      :options="lists.category"
                      :reduce="entry => entry.id"
                      @input="updateCategory"
                      @search.focus="focusField('category')"
                      @search.blur="clearFocus"
                    />
                  </div>
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.title,
                      'is-focused': activeField == 'title'
                    }"
                  >
                    <label class="bmd-label-floating required">{{
                      $t('cruds.blog.fields.title')
                    }}</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.title"
                      @input="updateTitle"
                      @focus="focusField('title')"
                      @blur="clearFocus"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.blog.fields.content') }}</label>
                    <ckeditor
                      :editor="editor"
                      :value="entry.content"
                      @input="updateContent"
                    >
                    </ckeditor>
                  </div>
                  <div class="form-group">
                    <label>{{ $t('cruds.blog.fields.images') }}</label>
                    <attachment
                      :route="getRoute('blogs')"
                      :collection-name="'blog_images'"
                      :media="entry.images"
                      :max-file-size="2"
                      :component="'pictures'"
                      :accept="'image/*'"
                      @file-uploaded="insertImagesFile"
                      @file-removed="removeImagesFile"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                {{ $t('global.save') }}
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import Attachment from '@components/Attachments/Attachment'

export default {
  components: {
    ClassicEditor,
    Attachment
  },
  data() {
    return {
      status: '',
      activeField: '',
      editor: ClassicEditor
    }
  },
  computed: {
    ...mapGetters('BlogsSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('BlogsSingle', [
      'storeData',
      'resetState',
      'setCategory',
      'setTitle',
      'setContent',
      'insertImagesFile',
      'removeImagesFile',
      'fetchCreateData'
    ]),
    updateCategory(value) {
      this.setCategory(value)
    },
    updateTitle(e) {
      this.setTitle(e.target.value)
    },
    updateContent(value) {
      this.setContent(value)
    },
    getRoute(name) {
      return `${axios.defaults.baseURL}${name}/media`
    },
    submitForm() {
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'blogs.index' })
          this.$eventHub.$emit('create-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
