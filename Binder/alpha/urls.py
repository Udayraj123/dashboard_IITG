from django.conf.urls import url
from discussions import views as dviews
from . import views

app_name='alpha'

urlpatterns = [
    url(r'^login/$', views.Login, name='login'),
    url(r'^logout/$', views.Logout, name='logout'),
    url(r'^home/$', dviews.post_list, name='list'),
]