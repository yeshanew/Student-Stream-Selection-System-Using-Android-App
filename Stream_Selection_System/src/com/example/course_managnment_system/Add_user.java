package com.example.course_managnment_system;
import android.os.AsyncTask;
import android.view.View;
import android.view.MenuItem;
import android.view.Menu;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import  android.widget.Button;
import android.widget.Spinner;
import android.widget.Toast;
import android.os.Bundle;
import android.app.Activity;
import android.app.ProgressDialog;
import android.widget.EditText;
import java.util.*;

import android.util.Log;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONObject;

import com.example.course_managnment_system.Add_course.addchoiceTask;
public class Add_user extends Activity {

	 Button button;
	 Spinner gender,spinner_health;
	  JSONParser jsonParser;
	    ProgressDialog progressDialog;
	    int value;
		  EditText fname,mname,lname,mobile,gpa,student_id;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_add_user);
	     button=(Button)findViewById(R.id.user_btn);
	     fname=(EditText)findViewById(R.id.fname);
	     mname=(EditText)findViewById(R.id.mname);
	     lname=(EditText)findViewById(R.id.lname);
	     gpa=(EditText)findViewById(R.id.gpa);
	     student_id=(EditText)findViewById(R.id.student_id);
	     mobile=(EditText)findViewById(R.id.mobile_no);
	     gender=(Spinner) findViewById(R.id.sex);
	     spinner_health=(Spinner) findViewById(R.id.Spinner_health);
	     jsonParser=new JSONParser();
	     List<String> list = new ArrayList<String>();
			list.add("Male");
			list.add("Female");
			ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this,
		    android.R.layout.simple_spinner_item, list);
			dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
			gender.setAdapter(dataAdapter);
		     List<String> list2 = new ArrayList<String>();
				list2.add("Normal");
				list2.add("Disable");
				ArrayAdapter<String> dataAdapter2 = new ArrayAdapter<String>(this,
			    android.R.layout.simple_spinner_item, list2);
				dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
				spinner_health.setAdapter(dataAdapter2);
				gender= (Spinner) findViewById(R.id.sex);
				spinner_health= (Spinner) findViewById(R.id.Spinner_health);
			button.setOnClickListener(new OnClickListener() {
				  public void onClick(View v) {
	            	new AddStudentTask().execute();


		            }
		        });

		    }

	    class AddStudentTask extends AsyncTask<String,String,String>{

	        @Override
	        protected void onPreExecute() {
	            super.onPreExecute();
	            progressDialog=new ProgressDialog(Add_user.this);
	            progressDialog.setTitle("Please Wait...");
	            progressDialog.show();
	            
	        }

	        @Override
	        protected String doInBackground(String... strings) {

	            List<NameValuePair>list= new ArrayList<NameValuePair>();
	            list.add(new BasicNameValuePair("Fname",fname.getText().toString()));
	            list.add(new BasicNameValuePair("Mname",mname.getText().toString()));
	            list.add(new BasicNameValuePair("Lname",lname.getText().toString()));
	            list.add(new BasicNameValuePair("Student_id",student_id.getText().toString()));
	            list.add(new BasicNameValuePair("Gpa",gpa.getText().toString()));
	            list.add(new BasicNameValuePair("Sex",String.valueOf(gender.getSelectedItem())));
	            list.add(new BasicNameValuePair("Phone_no",mobile.getText().toString()));
	            list.add(new BasicNameValuePair("Health",String.valueOf(spinner_health.getSelectedItem())));

	            JSONObject jsonObject=jsonParser.makeHttpRequest("http://192.168.43.64/stream_selection/add_student.php","POST",list);

	            try{
	              if(jsonObject!=null && !jsonObject.isNull("value")){
	                    value=jsonObject.getInt("value");
	              }else{
	                  value=0;
	              }

	            }catch (Exception e){
	                Log.d("ERROR",e.getMessage());
	            }

	            return null;
	        }
	        @Override
	        protected void onPostExecute(String s) {
	            super.onPostExecute(s);
	            if(value==1){
	                Toast.makeText(getApplicationContext(),"Successfully registered",Toast.LENGTH_LONG).show();
	            }else{
	                Toast.makeText(getApplicationContext(),"Not registered",Toast.LENGTH_LONG).show();
	            }
	            progressDialog.dismiss();
	        }


	    }
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.add_user, menu);
		return true;
	}
	@Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
