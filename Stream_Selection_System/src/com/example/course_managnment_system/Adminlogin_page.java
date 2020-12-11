package com.example.course_managnment_system;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;
import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Adminlogin_page extends Activity {

	Button butn;
	  EditText user,pass;
	  JSONParser jsonParser;
	    ProgressDialog progressDialog;
	    int value;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_adminlogin_page);
		  butn=(Button)findViewById(R.id.admin_btn);
		     user=(EditText)findViewById(R.id.login_username);
		     pass=(EditText)findViewById(R.id.login_password);
		     jsonParser=new JSONParser();
		     butn.setOnClickListener(new View.OnClickListener() {
		            @Override
		            public void onClick(View view) {
		                new loginpage().execute();
		            }
		        });
	}
	class loginpage extends AsyncTask<String,String,String>{

      @Override
      protected void onPreExecute() {
          super.onPreExecute();
          progressDialog=new ProgressDialog(Adminlogin_page.this);
          progressDialog.setTitle("Please Wait...");
          progressDialog.show();
      }

      @Override
      protected String doInBackground(String... strings) {

          List<NameValuePair>list= new ArrayList<NameValuePair>();
          list.add(new BasicNameValuePair("User",user.getText().toString()));
          list.add(new BasicNameValuePair("Pass",pass.getText().toString()));
          JSONObject jsonObject=jsonParser.makeHttpRequest("http://192.168.43.64//stream_selection/admin_login.php","POST",list);

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
          	 Intent i=new Intent(getApplicationContext(),Admin_page.class);
             //Create the bundle
             Bundle bundle = new Bundle();
             //Add your data to bundle
             bundle.putString("stud_id",user.getText().toString());
             bundle.putString("stud_pass",pass.getText().toString());  
             //Add the bundle to the intent
             i.putExtras(bundle);
               startActivity(i);
          }else{
          	//Bundle bundle = getIntent().getExtras();
             // String text= bundle.getString("O");
             // Toast.makeText(getApplicationContext(),text+"PleaseEEEEEEEEEE enter",Toast.LENGTH_LONG).show();
          	 Toast.makeText(getApplicationContext(),"Please enter the correct username and Password!",Toast.LENGTH_LONG).show();
          	Intent i=new Intent(getApplicationContext(),Adminlogin_page.class);
              startActivity(i);
             
          }
          progressDialog.dismiss();
      }


  }
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.adminlogin_page, menu);
		return true;
	}

	public boolean onOptionsItemSelected(MenuItem item) {
      int id = item.getItemId();
      if (id == R.id.action_settings) {
          return true;
      }

      return super.onOptionsItemSelected(item);
  }
}