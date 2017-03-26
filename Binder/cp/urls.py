from django.conf.urls import url
from . import views

app_name='cp'

urlpatterns = [

    url(r'^$', views.index, name='index'),
    url(r'^login/$', views.loginuser, name='login'),
    url(r'^logout/$', views.logoutuser, name='logout'),
    url(r'^signup/$', views.signup, name='signup'),
    url(r'^view/(?P<course_id>[0-9]+)/$', views.viewlist, name='viewlist'),
    url(r'^add/(?P<course_id>[0-9]+)/$', views.add, name='add'),
    url(r'^documents/(?P<filter_by>[a-zA_Z]+)/$', views.documents, name='documents'),

]
