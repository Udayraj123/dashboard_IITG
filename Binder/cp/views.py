from django.contrib.auth import authenticate, login, logout
from django.db.models import Q
from django.http import HttpResponseRedirect
from django.shortcuts import render, get_object_or_404
from .forms import UserForm, DocumentsForm
from .models import loguser, course, document
# Create your views here.

def loginuser(request):
    if request.method == 'POST':
        username = request.POST['username']
        password = request.POST['password']
        user = authenticate(username=username, password=password)
        if user is not None:
            if user.is_active:
                login(request, user)
                courses = course.objects.filter(user=request.user)
                return render(request, 'cp/index.html', {'courses':courses})
            else:
                return render(request, 'cp/login.html', {'error_message':'Your account has been disabled!'})
        else:
            return render(request, 'cp/login.html', {'error_message':'Invalid Credentials!'})
    return render(request, 'cp/login.html')

def logoutuser(request):
    logout(request)
    form = UserForm(request.POST or None)
    context = {
        "form": form,
    }
    return render(request, 'cp/login.html', context)

def signup(request):
    form = UserForm(request.POST or None)
    if form.is_valid():
        user = form.save(commit=False)
        username = form.cleaned_data['username']
        password = form.cleaned_data['password']
        user.set_password(password)
        user.save()
        user = authenticate(username=username, password=password)
        if user is not None:
            if user.is_active:
                login(request, user)
                courses = course.objects.filter(user=request.user)
                return render(request, 'cp/index.html', {'courses':courses})
    context={
        "form":form
    }
    return render(request, 'cp/register.html', context)

def viewlist(request, course_id):
    if not request.user.is_authenticated():
        return render(request, 'cp/login.html')
    else:
        user = request.user
        courses = get_object_or_404(course, pk=course_id)
        poster=""
        for k in courses.document_set.all():
            poster = k.postedby
            break
        return render(request, 'cp/detail.html', {'courses':courses, 'user':user, 'poster':poster})

def add(request, course_id):
    form = DocumentsForm(request.POST or None, request.FILES or None)
    courses = get_object_or_404(course, pk=course_id)
    poster = ""
    for k in courses.document_set.all():
        poster = k.postedby
        break
    if form.is_valid():
        documents = courses.document_set.all()
        documentnew = form.save(commit=False)
        documentnew.course = courses
        if 'lecture_file' in request.FILES.keys():
            documentnew.lecture = request.FILES['lecture_file']
        if 'tutorial_file' in request.FILES.keys():
            documentnew.tutorial = request.FILES['tutorial_file']
        documentnew.postedby = request.user
        documentnew.save()
        return render(request, 'cp/detail.html', {'courses':courses, 'poster':poster})
    context={
        'courses':courses,
        'form':form,
        'poster':poster
    }
    return render(request, 'cp/create_document.html', context)

def index(request):
    if not request.user.is_authenticated():
        return render(request, 'cp/login.html')
    else:
        courses = course.objects.filter(user=request.user)
        document_results = document.objects.all()
        query = request.GET.get("q")
        if query:
            courses = courses.filter(
                Q(title__icontains=query)
            ).distinct()
            document_results = document_results.filter(
                Q(book_link__icontains=query) |
                Q(lecture__icontains=query) |
                Q(tutorial__icontains=query)
            ).distinct()
            return render(request, 'cp/index.html', {
                'courses': courses,
                'documents': document_results,
            })
        return render(request, 'cp/index.html', {'courses':courses})

def documents(request, filter_by):
    if not request.user.is_authenticated():
        return render(request, 'cp/login.html')
    else:
        try:
            document_ids = []
            for courses in course.objects.filter(user=request.user):
                for documentss in courses.document_set.all():
                    document_ids.append(documentss.pk)
            users_documents = document.objects.filter(pk__in=document_ids)
        except courses.DoesNotExist:
            users_documents = []
        return render(request, 'cp/songs.html', {
            'document_list': users_documents,
            'filter_by': filter_by,
        })





