from django import forms
from django.contrib.auth.models import User

from .models import loguser, document


from django.core.exceptions import ValidationError

def set_field_html_name(cls, new_name):
    old_render = cls.widget.render
    def _widget_render_wrapper(name, value, attrs=None):
        return old_render(new_name, value, attrs)
    cls.widget.render = _widget_render_wrapper

class UserForm(forms.ModelForm):
    password = forms.CharField(widget=forms.PasswordInput)

    class Meta:
        model = User
        fields= ['username', 'password', 'email']

class DocumentsForm(forms.ModelForm):
    book_link = forms.CharField(required=False)
    lecture = forms.FileField(required=False)
    tutorial = forms.FileField(required=False)
    set_field_html_name(lecture,'lecture_file')
    set_field_html_name(tutorial, 'tutorial_file')

    class Meta:
        model = document
        fields = ['book_link', 'lecture', 'tutorial']