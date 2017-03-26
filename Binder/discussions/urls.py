from django.conf.urls import url
from . import views

app_name='discussions'

urlpatterns = [
    url(r'^$', views.post_list, name="list"),
    url(r'index/$', views.index),
    url(r'^(?P<id>\d+)/$', views.post_detail, name="detail"),
    url(r'^(?P<id>\d+)/edit/$', views.edit_post),
    url(r'^(?P<id>\d+)/delete/$', views.post_delete),
    url(r'create/$', views.create_post, name='create_post'),
    url(r'profile/$', views.profile, name='profile'),


]