<?php

namespace App\Http\Controllers\Admin\Main;

use Illuminate\Http\Request;
use App\Models\RulesAndRegulations;
use App\Http\Controllers\Controller;

class RulesAndRegulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.rules.index')->with('rulesandregulations',RulesAndRegulations::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.rules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'pdf' => 'required|mimes:pdf',           
            

       ]);

       if ($validator->fails()) {
           // dd("in if");
           return  redirect()->back()
                       ->withErrors($validator)
                       ->withInput($request->except('password'))
                       ->with('autofocus', true);
       }


        $rule = new RulesAndRegulations;
        $rule->name=$request->input('name');
        $rule->description=$request->input('description');

    //    $description = str_replace(' ', '', $request->description);


    //     if($description ==""){
    //         return redirect()->back()->with('error','Description cannot be empty')->withInput();

    //     }else{
    //         $rule->description=$request->input('description');

    //     }
        if($request->hasFile('pdf'))
        {
            $rule_pdf = request()->pdf->getClientOriginalName();
            request()->pdf->move('storage/main/rules&regulation/', $rule_pdf);
            $rule->pdf='/storage/main/rules&regulation/'.$rule_pdf;
        }
        $rule->save();

        return redirect(route('admin.rulesandregulations.index'))->with('success','Rule Added Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.admin.main.rules.edit')->with('rule',RulesAndRegulations::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'pdf' => 'sometimes|mimes:pdf',           
            

       ]);

       if ($validator->fails()) {
           // dd("in if");
           return  redirect()->back()
                       ->withErrors($validator)
                       ->withInput($request->except('password'))
                       ->with('autofocus', true);
       }


        $rule =  RulesAndRegulations::find($id);
        $rule->name=$request->input('name');
        // $rule->description=$request->input('description');
        $description = str_replace(' ', '', $request->description);


        if($description ==""){
            return redirect()->back()->with('error','Description cannot be empty')->withInput();

        }else{
            $rule->description=$request->input('description');

        } 
        if($request->hasFile('pdf'))
        {
            $rule_pdf = request()->pdf->getClientOriginalName();
            request()->pdf->move('storage/main/rules&regulation/', $rule_pdf);
            $rule->pdf='/storage/main/rules&regulation/'.$rule_pdf;
        }
        $rule->save();

        return redirect(route('admin.rulesandregulations.index'))->with('success','Rule Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rule =  RulesAndRegulations::find($id);
        $path = ltrim($rule->pdf, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }
        $rule->delete();

        return redirect(route('admin.rulesandregulations.index'))->with('success','Rule Deleted Successfully');

    }
}
