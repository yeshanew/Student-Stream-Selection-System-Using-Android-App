package com.example.course_managnment_system;

import  android.widget.Button;
import android.widget.Toast;
import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.app.ProgressDialog;
import org.apache.http.NameValuePair;
import android.util.Log;
import android.view.View;
import java.util.ArrayList;
import java.util.List;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONObject;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
public class Add_course extends Activity {
	private Spinner spinner1,spinner2,spinner3;
	  private Button btnSubmit;
		JSONParser jsonParser;
	    ProgressDialog progressDialog;
	    int value;
	    int jsonlength;
	    String[] name;
	  @Override
	  public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_add_course);
		jsonParser=new JSONParser();
		 new DisplayUserTask().execute();

	  }
	  class DisplayUserTask extends AsyncTask<String,String,String> {

	        @Override
	        protected void onPreExecute() {
	            super.onPreExecute();
	            progressDialog=new ProgressDialog(Add_course.this);
	            progressDialog.setTitle("Please Wait...");
	            progressDialog.show();
	        }

	        @Override
	        protected String doInBackground(String... strings) {

	            List<NameValuePair>list= new ArrayList<NameValuePair>();


	            JSONObject jsonObject=jsonParser.makeHttpRequest("http://192.168.43.64/stream_selection/display_stream.php","POST",list);

	            try{
		              if(jsonObject!=null && !jsonObject.isNull("value")){
		                    value=jsonObject.getInt("value");
	                    JSONArray jsonArray=jsonObject.getJSONArray("stream");
	                    name=new String[jsonArray.length()];
	                    jsonlength=jsonArray.length();
	                    for(int i=0;i<jsonArray.length();i++){
	                        JSONObject objcet=jsonArray.getJSONObject(i);
	                        name[i]=objcet.getString("Name");
	                    }
	                }else{
	                    value=0;
	                }

	            }catch (Exception e){
	                Log.d("ERROR", e.getMessage());
	            }

	            return null;
	        }
	        @Override
	        protected void onPostExecute(String s) {
	            super.onPostExecute(s);
	            if(value==1){
	            	spinner2 = (Spinner) findViewById(R.id.spinner2);
	            	spinner1 = (Spinner) findViewById(R.id.spinner1);
	            	spinner3 = (Spinner) findViewById(R.id.spinner3);
	            	List<String> list1 = new ArrayList<String>();
	            	 for(int i=0;i<jsonlength;i++){
	            	list1.add(name[i]);
	            	 }
	            	List<String> list2 = new ArrayList<String>();
	            	 for(int i=0;i<jsonlength;i++){
	            	list2.add(name[i]);
	            	 }
	            	List<String> list3 = new ArrayList<String>();
	            	 for(int i=0;i<jsonlength;i++){
	            	list3.add(name[i]);
	            	 }
	          		ArrayAdapter<String> dataAdapter1=new ArrayAdapter<String>(Add_course.this,
	                  		android.R.layout.simple_spinner_item,list1);
	                  		dataAdapter1.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
	                  		spinner2.setAdapter(dataAdapter1);
	        
	               ArrayAdapter<String> dataAdapter2=new ArrayAdapter<String>(Add_course.this,
	    	                  		android.R.layout.simple_spinner_item,list2);
	    	                  		dataAdapter2.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
	    	                  		spinner1.setAdapter(dataAdapter2);
	    	       ArrayAdapter<String> dataAdapter3=new ArrayAdapter<String>(Add_course.this,
	    	    	                  		android.R.layout.simple_spinner_item,list3);
	    	    	                  		dataAdapter3.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
	    	    	                  		spinner3.setAdapter(dataAdapter3);
	            }else{
	                Toast.makeText(getApplicationContext(),"Error...",Toast.LENGTH_LONG).show();
	            }
	            progressDialog.dismiss();
	    		addListenerOnButton();
	    		//addListenerOnSpinnerItemSelection();
	        }      
	  }
	       

	  public void addListenerOnSpinnerItemSelection() {
		spinner2 = (Spinner) findViewById(R.id.spinner2);
		spinner2.setOnItemSelectedListener(new CustomOnItemSelectedListener());
	  }

	  // get the selected dropdown list value
	  public void addListenerOnButton() {

		spinner2 = (Spinner) findViewById(R.id.spinner2);
		spinner1 = (Spinner) findViewById(R.id.spinner1);
		spinner3 = (Spinner) findViewById(R.id.spinner3);
		btnSubmit = (Button) findViewById(R.id.submit_btn1);

		btnSubmit.setOnClickListener(new OnClickListener() {

		  @Override
		  public void onClick(View v) {
			  new addchoiceTask().execute();
			 
		  }

		});
	  }
	  class addchoiceTask extends AsyncTask<String,String,String>{
	        @Override
	        protected void onPreExecute() {
	            super.onPreExecute();
	            progressDialog=new ProgressDialog(Add_course.this);
	            progressDialog.setTitle("Please Wait...");
	            progressDialog.show();
	        }

	        @Override
	  protected String doInBackground(String... strings) {

	  List<NameValuePair>list= new ArrayList<NameValuePair>();
      list.add(new BasicNameValuePair("Fchoice",String.valueOf(spinner2.getSelectedItem())));
      list.add(new BasicNameValuePair("Schoice",String.valueOf(spinner1.getSelectedItem())));
      list.add(new BasicNameValuePair("Tchoice",String.valueOf(spinner3.getSelectedItem())));

      JSONObject jsonObject=jsonParser.makeHttpRequest("http://192.168.43.64/stream_selection/add_stream.php","POST",list);

      try{
        if(jsonObject!=null && !jsonObject.isNull("value")){
              value=jsonObject.getInt("value");
        }else{
            value=0;
        }

      }catch (Exception e){
          Log.d("ERROR",e.getMessage());
      }
      progressDialog.dismiss();
      
      return null;
      }
	    
      @Override
      protected void onPostExecute(String s) {
          super.onPostExecute(s);
          if(value==1){
              Toast.makeText(getApplicationContext(),"Successfully Selected",Toast.LENGTH_LONG).show();
          }else{
              Toast.makeText(getApplicationContext(),"The stream are not selected",Toast.LENGTH_LONG).show();
          }
          progressDialog.dismiss();
      }
	}
}