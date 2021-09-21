package com.monkeybit.routability;

import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.TextInputEditText;
import android.support.v4.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class AccountActivity extends Fragment {

    private FirebaseAuth mAuth;
    Button signInButton;
    Button newUserButton;
    TextInputEditText emailText;
    TextInputEditText passwordText;


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_account, container, false);
        mAuth = FirebaseAuth.getInstance();

        emailText = view.findViewById(R.id.eMailAut);
        passwordText = view.findViewById(R.id.passAut);

        signInButton = view.findViewById(R.id.SignIn);
        signInButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnSignIn(v);
            }
        });

        newUserButton = view.findViewById(R.id.NewUser);
        newUserButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                OnNewUser(v);
            }
        });

        return view;
        // return super.onCreateView(inflater, container, savedInstanceState);
    }

    @Override
    public void onStart() {
        super.onStart();
        // Check if user is signed in (non-null) and update UI accordingly.
        FirebaseUser currentUser = mAuth.getCurrentUser();
        //updateUI(currentUser);
        if (currentUser != null) {
            Toast toast = Toast.makeText(getActivity(), "Ya tienes sesion iniciada", Toast.LENGTH_SHORT);
            toast.show();
            mAuth.signOut();
            ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
        } else {
            Toast toast = Toast.makeText(getActivity(), "No tienes sesion iniciada", Toast.LENGTH_SHORT);
            toast.show();
        }
    }

    public void OnSignIn(android.view.View view) {
        String email = emailText.getText().toString();
        String password = passwordText.getText().toString();

        if (email.isEmpty() || password.isEmpty()) {
            //Show error on screen
            Toast toast = Toast.makeText(getActivity(), getResources().getString(R.string.empty_fields), Toast.LENGTH_SHORT);
            toast.show();
            return;
        }

        mAuth.signInWithEmailAndPassword(email, password)
                .addOnCompleteListener(getActivity(), new OnCompleteListener<AuthResult>() {
                        @Override
                        public void onComplete(@NonNull Task<AuthResult> task) {
                            if (task.isSuccessful()) {
                                // Sign in success, update UI with the signed-in user's information
                                Toast toast = Toast.makeText(getActivity(), getResources().getString(R.string.signed_in_successfully), Toast.LENGTH_SHORT);
                                toast.show();
                                FirebaseUser user = mAuth.getCurrentUser();
                                //updateUI(user);
                                ((MainActivity)getActivity()).LoadNewFragment(new MenuActivity());
                            } else {
                                // If sign in fails, display a message to the user.
                                Toast toast = Toast.makeText(getActivity(), getResources().getString(R.string.signed_in_fail), Toast.LENGTH_SHORT);
                                toast.show();
                                //updateUI(null);
                            }
                        }
                    });
    }

    public void OnNewUser(android.view.View view) {
        ((MainActivity)getActivity()).LoadNewFragment(new RegisterAccountActivity());
    }

}
