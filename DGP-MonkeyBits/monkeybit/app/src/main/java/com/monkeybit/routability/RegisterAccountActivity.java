package com.monkeybit.routability;

import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.TextInputEditText;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.auth.UserProfileChangeRequest;

import org.json.JSONObject;

public class RegisterAccountActivity extends Fragment implements DBConnectInterface {

    private FirebaseAuth mAuth;
    Button newUserButton;
    TextInputEditText emailText;
    TextInputEditText passwordText;
    TextInputEditText repeatPasswordText;
    TextInputEditText nameText;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_register_account, container, false);
        mAuth = FirebaseAuth.getInstance();

        emailText = view.findViewById(R.id.eMailAut);
        passwordText = view.findViewById(R.id.passAut);
        repeatPasswordText = view.findViewById(R.id.passAutRepeat);
        nameText = view.findViewById(R.id.UserName);

        newUserButton = view.findViewById(R.id.CreateAccount);
        newUserButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnCreateAccount(v);
            }
        });

        return view;
        // return super.onCreateView(inflater, container, savedInstanceState);
    }

    public void OnCreateAccount (android.view.View view) {
        String email = emailText.getText().toString();
        String password = passwordText.getText().toString();
        String passwordRepeat = repeatPasswordText.getText().toString();
        final String user_name = nameText.getText().toString();

        if (email.isEmpty() || password.isEmpty() || passwordRepeat.isEmpty() || user_name.isEmpty()) {
            Toast toast = Toast.makeText(getActivity(), getString(R.string.empty_fields), Toast.LENGTH_SHORT);
            toast.show();
            return;
        }

        if (password.equals(passwordRepeat)) {
            mAuth.createUserWithEmailAndPassword(email, password)
                    .addOnCompleteListener(getActivity(), new OnCompleteListener<AuthResult>() {
                        @Override
                        public void onComplete(@NonNull Task<AuthResult> task) {
                            if (task.isSuccessful()) {
                                // Sign in success, update UI with the signed-in user's information
                                FirebaseUser user = mAuth.getCurrentUser();
                                Toast toast = Toast.makeText(getActivity(), getString(R.string.create_account_succesfully), Toast.LENGTH_SHORT);
                                toast.show();
                                UpdateUserProfile(user_name);
                                addUserToDataBase(user.getEmail(), user_name);
                            } else {
                                // If sign in fails, display a message to the user.
                                Toast toast = Toast.makeText(getActivity(), "No se han podido recuperar los datos del usuario.", Toast.LENGTH_SHORT);
                                toast.show();
                                //updateUI(null);
                            }

                            // ...
                        }
                    });
        } else {
            //Show error on screen
            Toast toast = Toast.makeText(getActivity(), getString(R.string.passwords_not_equal), Toast.LENGTH_SHORT);
            toast.show();
            return;
        }
    }

    private void UpdateUserProfile(String userName) {
        FirebaseUser user = mAuth.getCurrentUser();

        UserProfileChangeRequest profileUpdates = new UserProfileChangeRequest.Builder()
                .setDisplayName(userName)
                .build();

        user.updateProfile(profileUpdates)
                .addOnCompleteListener(new OnCompleteListener<Void>() {
                    private static final String TAG = "Debug:";

                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        if (task.isSuccessful()) {
                            Log.d(TAG, "User profile updated.");
                            //Toast toast = Toast.makeText(getActivity(), "User profile updated.", Toast.LENGTH_SHORT);
                            //toast.show();
                        } else {
                            Log.d(TAG, "Something fail when updating user profile.");
                        }
                    }
                });
    }

    private void addUserToDataBase(String email, String name) {
        DBConnect.addUser(getContext(), this, email, name);
    }

    @Override
    public void onErrorResponse(VolleyError error) {
        Toast.makeText(getContext(),"Fallo al añadir al usuario a la BD.", Toast.LENGTH_LONG);
        ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
    }

    @Override
    public void onResponse(JSONObject response) {
        Toast.makeText(getContext(),"Usuario añadido a la BD correctamente.", Toast.LENGTH_LONG);
        ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
    }
}
