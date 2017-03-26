from django.conf.urls import url
from . import views
from django.contrib import admin
from django.views.generic import TemplateView

urlpatterns = [
    url(r'^$',views.nb, name='notice_board'),
    url(r'^add',views.add, name='add'),
    url(r'^post',views.post, name='post')
]