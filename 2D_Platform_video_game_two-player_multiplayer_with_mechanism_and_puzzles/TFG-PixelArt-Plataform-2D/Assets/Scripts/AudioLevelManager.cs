﻿// This script is a Manager that controls all of the audio for the project. All audio
// commands are issued through the static methods of this class. Additionally, this 
// class creates AudioSource "channels" at runtime and manages them

using UnityEngine;
using UnityEngine.Audio;

public class AudioLevelManager : MonoBehaviour
{
    AudioLevelManager() { }

    //This class holds a static reference to itself to ensure that there will only be
    //one in existence. This is often referred to as a "singleton" design pattern.
    public static AudioLevelManager Instance = null;

    [Header("Ambient Audio")] //The background music 
    [SerializeField] public AudioClip musicClip = null;
    [SerializeField] public AudioClip puzzleClip = null;

    [Header("Buttons")]
    [SerializeField] AudioClip ButtonClip = null;     //Sounds when you push a button

    [Header("Objects")]
    [SerializeField] AudioClip PuzzleClip = null;     //Sounds when a puzzle starts
    [SerializeField] AudioClip RotatePuzzleClip = null;     //Sounds when rotate a image of the puzzle
    [SerializeField] AudioClip ChangePuzzleClip = null;     //Sounds when change a image of the puzzle
    [SerializeField] AudioClip CollectionClip = null;     //Sounds when a puzzle is completed

    [Header("Stings")]
    [SerializeField] AudioClip shadowCaptureClip = null;     //The sting played when the shadow is captured
    [SerializeField] AudioClip typeSentenceAudio = null;    //The sting played when the letter is written

    [Header("Player Audio")]
    [SerializeField] AudioClip jumpClip = null;             //The player jump
    [SerializeField] AudioClip walkStepClip = null;         //The player walk

    [Header("Mixer Groups")]
    [SerializeField] AudioMixerGroup musicGroup = null;     //The music mixer group
    [SerializeField] AudioMixerGroup effectGroup = null;    //The effect mixer group
    [SerializeField] AudioMixerGroup playerGroup = null;    //The player mixer group
    [SerializeField] AudioMixerGroup voiceGroup = null;     //The voice mixer group

    AudioSource musicSource;            //Reference to the generated music Audio Source
    AudioSource effectSource;           //Reference to the generated effect Audio Source
    AudioSource playerSisterSource;     //Reference to the generated player sister Audio Source
    AudioSource playerBrotherSource;    //Reference to the generated player brother Audio Source
    AudioSource voiceSource;            //Reference to the generated voice Audio Source


    void Awake()
    {
        //Destroy the music of the menus
        GameObject musicMenu = GameObject.Find("MusicMenu");

        if (musicMenu != null)
        {
            Destroy(musicMenu);
        }

        //If an AudioLevelManager exists and it is not this...
        if (Instance != null && Instance != this)
        {
            Debug.LogError("Error with AudioLevelManager script components, 2 instances " + this);
            //...destroy this and exit. There can be only one AudioLevelManager
            Destroy(gameObject);
            return;
        }

        //This is the Instance AudioLevelManager, we use it for use the class's methods.
        Instance = this;

        //Generate the Audio Source "channels" for our game's audio
        musicSource = gameObject.AddComponent<AudioSource>() as AudioSource;
        effectSource = gameObject.AddComponent<AudioSource>() as AudioSource;
        playerSisterSource = gameObject.AddComponent<AudioSource>() as AudioSource;
        playerBrotherSource = gameObject.AddComponent<AudioSource>() as AudioSource;
        voiceSource = gameObject.AddComponent<AudioSource>() as AudioSource;

        //Assign each audio source to its respective mixer group so that it is
        //routed and controlled by the audio mixer
        musicSource.outputAudioMixerGroup = musicGroup;
        effectSource.outputAudioMixerGroup = effectGroup;
        playerSisterSource.outputAudioMixerGroup = playerGroup;
        playerBrotherSource.outputAudioMixerGroup = playerGroup;
        voiceSource.outputAudioMixerGroup = voiceGroup;

        //Being playing the game audio
        StartLevelAudio();
    }

    void StartLevelAudio()
    {
        //Set the clip for music audio, tell it to loop, and then tell it to play
        musicSource.clip = musicClip;
        musicSource.loop = true;
        musicSource.volume = 1;
        musicSource.Play();
    }

    public void PlayFootstepAudio(bool isSister)
    {
        /*//Pick a random footstep sound
        int index = Random.Range(0, current.walkStepClips.Length);*/

        if (isSister)
        {
            //Set the footstep clip and tell the source to play
            playerSisterSource.Stop();
            playerSisterSource.clip = walkStepClip;
            playerSisterSource.Play();
        }
        else
        {
            //Set the footstep clip and tell the source to play
            playerBrotherSource.Stop();
            playerBrotherSource.clip = walkStepClip;
            playerBrotherSource.Play();
        }
        
    }

    public void PlayJumpAudio(bool isSister)
    {
        if (isSister)
        {
            //Set the jump clip and tell the source to play
            playerSisterSource.Stop();
            playerSisterSource.clip = jumpClip;
            playerSisterSource.Play();
        }
        else
        {
            //Set the jump clip and tell the source to play
            playerBrotherSource.Stop();
            playerBrotherSource.clip = jumpClip;
            playerBrotherSource.Play();
        }
    }

    public void PlayLetterAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = typeSentenceAudio;
        effectSource.Play();
    }

    public void PlayShadowCollectionAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = shadowCaptureClip;
        effectSource.Play();
    }

    public void PlayButtonAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = ButtonClip;
        effectSource.Play();
    }

    public void PlayPuzzleAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = PuzzleClip;
        effectSource.Play();
    }

    public void PlayCollectionAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = CollectionClip;
        effectSource.Play();
    }

    public void PlayRotatePuzzleClipAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = RotatePuzzleClip;
        effectSource.Play();
    }

    public void PlayChangePuzzleClipAudio()
    {
        //Set the shadow sting clip and tell the source to play
        effectSource.clip = ChangePuzzleClip;
        effectSource.Play();
    }

    public void PlayChangeClipAudio(AudioClip newAudio)
    {
        //Change the clip for music audio and then tell it to play
        musicSource.Stop();
        musicSource.clip = newAudio;
        musicSource.Play();
    }
}