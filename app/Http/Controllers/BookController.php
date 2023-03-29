<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Header;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // DASHBOARD GUEST
    public function index()
    {
        $headers = Header::all();
        return view('index', compact('headers'));
    }

    // DASHBOARD ADMIN
    public function admin()
    {
        return view('admin.index');
    }

    // BOOK SECTION
    public function book()
    {
        $books = Book::all();
        return view('admin.book', compact('books'));
    }

    public function bookCreate()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('admin.book_create', compact('books', 'categories'));
    }

    public function bookPost(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:5',
            'writer' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'synopsis' => 'required|min:10',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Simpan file yang diupload ke direktori
        $image = $request->file('cover');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/assets/img/cover', $filename);

        // Simpan nama file ke database
        $book = new Book();
        $book->cover = $filename;

        // Simpan data book ke database
        $book->title = $request->input('title');
        $book->writer = $request->input('writer');
        $book->publisher = $request->input('publisher');
        $book->isbn = $request->input('isbn');
        $book->category = $request->input('category');
        $book->synopsis = $request->input('synopsis');
        $book->save();

        return redirect('/admin/book')->with('createBook', 'Book has been created.');
    }

    // END BOOK SECTION

    // CATEGORY SECTION
    public function category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function categoryCreate(Request $request)
    {
        $request->validate([
            'category' => 'required|min:3',
        ]);

        Category::create([
            'category' => $request->category,
        ]);
        return redirect('/admin/category')->with('createCategory', 'Berhasil menambahkan Category!');
    }
    // END CATEGORY SECTION

    // HEADER SECTION
    public function header()
    {
        $headers = Header::all();
        return view('admin.header', compact('headers'));
    }

    public function updateHeader(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'heading' => 'required|min:5',
            'subheading' => 'required|min:5',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
        ]);
    
        // Ambil data header yang akan diperbarui
        $header = Header::findOrFail($id);
    
        // Cek apakah ada file yang diupload
        if ($request->hasFile('banner')) {
            // Hapus file lama jika ada
            if (Storage::disk('public')->exists('assets/img/banner/' . $header->banner)) {
                Storage::disk('public')->delete('assets/img/banner/' . $header->banner);
            }
    
            // Simpan file yang diupload ke direktori
            $image = $request->file('banner');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/assets/img/banner', $filename);
    
            // Simpan nama file ke database
            $header->banner = $filename;
        }
    
        // Simpan data header ke database
        $header->heading = $request->input('heading');
        $header->subheading = $request->input('subheading');
        $header->save();
    
        return redirect('/admin/header')->with('updateHeader', 'Header has been updated.');
    }
    // END HEADER SECTION
    
    // ADMIN LAYOUT
    public function page()
    {
        return view('admin.page');
    }
    
    // LIBRARY SECTION
        public function library(Request $request)
        {
            $books = Book::all();
            $categories = Category::all();
            
            return view('user.library', compact('books', 'categories'));
        }
        public function libraryCategory($category = null)
        {
            if ($category == 'All') {
                $books = Book::all();
            } else {
                $books = Book::where('category', $category)->get();
            }
            
            $categories = Category::all();
            
            return view('user.library', compact('categories', 'books'));
        }

    // END LIBRARY SECTION

    public function error()
    {
        return view('error');
    }

    // USER SECTION
    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }
    public function editUser($id)
    {
        $users = User::where('id', $id)->first();
        return view('admin.user_update', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        // validasi
        $request->validate([
            'name' => 'min:3',
            'email' => 'min:5',
            'phone' => 'min:11',
        ]);
        // mencari baris data yang punya value column id sama dengan id yang dikirim ke route
        User::where('id', $id)->update([
            'name' => $request->name,
            'region' => $request->region,
            'password' => $request->password,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);
        // kalau berhasil, arahkan ke halaman data dengan pemberitahuan berhasil
        return redirect('/admin/user')->with('userUpdate', 'User berhasil diperbaharui!');
    }
    // END USER SECTION

    // DELETE USER
    public function delete($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect('/admin/user')->with('destroySuccess', 'Berhasil menghapus data!');
    }
    // DELETE BOOK
    public function deleteBook($id)
    {
        Book::where('id', '=', $id)->delete();
        return redirect('/admin/book')->with('destroySuccess', 'Berhasil menghapus data!');
    }
    // DELETE CATEGORY
    public function deleteCategory($id)
    {
        Category::where('id', '=', $id)->delete();
        return redirect('/admin/category')->with('destroySuccess', 'Berhasil menghapus data!');
    }

    // LOGIN SECTION
    public function login()
    {
        return view('login');
    }
    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:4',
        ],[
            'email.exists' => "This email doesn't exists"
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            if (Auth::user()->role == 'admin') {
                return redirect ('/page');
            }else{
                return redirect('/library');
            }
        }
        return redirect('/login')->with('fail', 'Gagal login, periksa Email atau Password & coba lagi!');
    }
    // END LOGIN SECTION


    // REGISTER SECTION
    public function register()
    {
        return view('register');
    }
    public function registerPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:4',
            'name' => 'required|min:3',
            'region' => 'required',
            'phone' => 'required|min:11',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'region' => $request->region,
        ]);
        return redirect('/login')->with('success', 'Berhasil menambahkan akun! silahkan login');
    }
    // END REGISTER SECTION

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
